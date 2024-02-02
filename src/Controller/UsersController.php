<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Entity\Users;
use App\Repository\CustomersRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class UsersController extends AbstractController
{
    /** Cette méthode permet de récupérer l'ensemble des utilisateurs.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne la liste des utilisateurs",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Users::class, groups={"getUsers"}))
     *     )
     * )
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="La page que l'on veut récupérer",
     *     @OA\Schema(type="int")
     * )
     *
     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Le nombre d'éléments que l'on veut récupérer",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="Users")
     *
     * @param UsersRepository     $usersRepository parameter
     * @param SerializerInterface $serializer      parameter
     * @param Request             $request         parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/users", name="users", methods="GET")
     */
    public function getUsersList(
        UsersRepository $usersRepository,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse {

        /** @var Customers $customer */
        $customer = $this->getUser();

        /** @var int $page */
        $page = $request->get('page', 1);
        /** @var int $limit */
        $limit = $request->get('limit', 20);

        $userList = $usersRepository->findAllWithPagination($page, $limit, $customer);
        $context = SerializationContext::create()->setGroups(['getUsers']);
        $jsonUserList = $serializer->serialize($userList, 'json', $context);
        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }


    /** Cette méthode permet de récupérer les détails d'un utilisateur.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne les détails d'un utilisateur",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Users::class, groups={"getUsers"}))
     *     )
     * )
     *
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="L'ID de l'utilisateur que l'on veut récupérer",
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Tag(name="Users")
     * @param Users               $users      parameter
     * @param SerializerInterface $serializer parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/users/{id}", name="detailUser", methods="GET")
     */
    public function getDetailUser(Users $users, SerializerInterface $serializer): JsonResponse
    {

        /** @var Customers $customer */
        $customer = $this->getUser();

        if ($customer->getId() !== $users->getCustomer()->getId()) {
            return new JsonResponse("Vous n'êtes pas autorisé à voir cet utilisateur.", Response::HTTP_UNAUTHORIZED);
        }

        $context = SerializationContext::create()->setGroups(['getUsers']);
        $jsonUser = $serializer->serialize($users, 'json', $context);
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }


    /** Cette méthode permet d'ajouter un utilisateur.
     *
     * @OA\Response(
     *     response=200,
     *     description="Ajouter un utilisateur",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Users::class, groups={"getUsers"}))
     *     )
     * )
     *
     * @OA\RequestBody(
     *     @Model(type=Users::class),
     *     description="Description du corps de la requête",
     *     required=true
     * )
     *
     * @OA\Tag(name="Users")
     *
     * @param Request                $request             parameter
     * @param SerializerInterface    $serializer          parameter
     * @param EntityManagerInterface $manager             parameter
     * @param UrlGeneratorInterface  $urlGenerator        parameter
     * @param ValidatorInterface     $validator           parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/users", name="createUser", methods="POST")
     */
    public function createUsers(Request $request, SerializerInterface $serializer, EntityManagerInterface $manager, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator): JsonResponse
    {
        /** @var Users $user */
        $user = $serializer->deserialize($request->getContent(), Users::class, 'json');

        $errors = $validator->validate($user);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        /** @var Customers $customer */
        $customer = $this->getUser();

        $user->setCustomer($customer);

        $manager->persist($user);
        $manager->flush();

        $context = SerializationContext::create()->setGroups(['getUsers']);
        $jsonUser = $serializer->serialize($user, 'json', $context);
        $location = $urlGenerator->generate('detailUser', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED, ["Location" => $location], true);
    }


    /** Cette méthode permet de modifier un utilisateur.
     *
     * @OA\Response(
     *     response=200,
     *     description="Modifie un utilisateur",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Users::class, groups={"getUsers"}))
     *     )
     * )
     *
     * @OA\RequestBody(
     *     @Model(type=Users::class),
     *     description="Description du corps de la requête",
     *     required=true
     * )
     *
     * @OA\Tag(name="Users")
     *
     * @param Request                $request     parameter
     * @param SerializerInterface    $serializer  parameter
     * @param Users                  $currentUser parameter
     * @param EntityManagerInterface $manager     parameter
     * @param UrlGeneratorInterface  $urlGenerator parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/users/{id}", name="updateUser", methods="PUT")
     */
    public function updateUser(Request $request, SerializerInterface $serializer, Users $currentUser, EntityManagerInterface $manager, UrlGeneratorInterface $urlGenerator): JsonResponse
    {

        /** @var Customers $customer */
        $customer = $this->getUser();

        if ($customer->getId() !== $currentUser->getCustomer()->getId()) {
            return new JsonResponse("Vous n'êtes pas autorisé à modifier cet utilisateur.", Response::HTTP_UNAUTHORIZED);
        }

        /** @var Users $updatedUser */
        $updatedUser = $serializer->deserialize($request->getContent(), Users::class, 'json');

        if ($updatedUser->getZipcode() !== null) {
            $currentUser->setZipcode($updatedUser->getZipcode());
        }

        if ($updatedUser->getCity() !== null) {
            $currentUser->setCity($updatedUser->getCity());
        }

        if ($updatedUser->getAddress() !== null) {
            $currentUser->setAddress($updatedUser->getAddress());
        }

        if ($updatedUser->getEmail() !== null) {
            $currentUser->setEmail($updatedUser->getEmail());
        }

        if ($updatedUser->getLastname() !== null) {
            $currentUser->setLastname($updatedUser->getLastname());
        }

        if ($updatedUser->getFirstname() !== null) {
            $currentUser->setFirstname($updatedUser->getFirstname());
        }

        $manager->persist($currentUser);
        $manager->flush();

        $context = SerializationContext::create()->setGroups(['getUsers']);
        $jsonUser = $serializer->serialize($currentUser, 'json', $context);
        $location = $urlGenerator->generate('detailUser', ['id' => $currentUser->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED, ["Location" => $location], true);
    }


    /** Cette méthode permet de supprimer un utilisateur.
     *
     * @OA\Response(
     *     response=204,
     *     description="Supprime un utilisateur"
     * )
     *
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="L'ID de l'utilisateur que l'on veut récupérer",
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Tag(name="Users")
     *
     * @param Users                  $users   parameter
     * @param EntityManagerInterface $manager parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/users/{id}", name="deleteUsers", methods="DELETE")
     */
    public function deleteUser(Users $users, EntityManagerInterface $manager): JsonResponse
    {

        /** @var Customers $customer */
        $customer = $this->getUser();

        if ($customer->getId() !== $users->getCustomer()->getId()) {
            return new JsonResponse("Vous n'êtes pas autorisé à supprimer cet utilisateur.", Response::HTTP_UNAUTHORIZED);
        }

        $manager->remove($users);
        $manager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
