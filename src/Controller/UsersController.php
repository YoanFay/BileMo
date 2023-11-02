<?php

namespace App\Controller;

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
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UsersController extends AbstractController
{


    /**
     * @Route("/api/users", name="users", methods="GET")
     */
    public function getUsersList(
        UsersRepository    $usersRepository,
        SerializerInterface $serializer,
        Request             $request
    ): JsonResponse
    {

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $userList = $usersRepository->findAllWithPagination($page, $limit);
        $jsonUserList = $serializer->serialize($userList, 'json', ["groups" => "getUsers"]);
        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/users/{id}", name="detailUser", methods="GET")
     */
    public function getDetailUser(Users $users, SerializerInterface $serializer): JsonResponse
    {

        $jsonUser = $serializer->serialize($users, 'json', ["groups" => "getUsers"]);
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/users", name="createUser", methods="POST")
     */
    public function createUsers(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, CustomersRepository $customersRepository): JsonResponse
    {

        $user = $serializer->deserialize($request->getContent(), Users::class, 'json');

        $errors = $validator->validate($user);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $user->setCustomer($customersRepository->find($request->toArray()['idCustomer']));

        $em->persist($user);
        $em->flush();

        $jsonUser = $serializer->serialize($user, 'json', ["groups" => "getUsers"]);
        $location = $urlGenerator->generate('detailUser', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    /**
     * @Route("/api/users/{id}", name="updateUser", methods="PUT")
     */
    public function updateUser(Request $request, SerializerInterface $serializer, Users $currentUser, EntityManagerInterface $em): JsonResponse
    {

        $updatedUser = $serializer->deserialize(
            $request->getContent(),
            Users::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUser]
        );

        $em->persist($updatedUser);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }


    /**
     * @Route("/api/users/{id}", name="deleteUsers", methods="DELETE")
     */
    public function deleteUser(Users $users, EntityManagerInterface $em): JsonResponse
    {

        $em->remove($users);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
