<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Doctrine\ORM\EntityManagerInterface;
use ErrorException;
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
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class CustomersController extends AbstractController
{


    /** Cette méthode permet de récupérer l'ensemble des clients.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne la liste des clients",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Customers::class, groups={"getCustomers"}))
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
     * @OA\Tag(name="Customers")
     *
     * @param CustomersRepository $customersRepository parameter
     * @param SerializerInterface $serializer          parameter
     * @param Request             $request             parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/customers", name="customers", methods="GET")
     */
    /*public function getCustomersList(
        CustomersRepository $customersRepository,
        SerializerInterface $serializer,
        Request             $request
    ): JsonResponse
    {

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $customerList = $customersRepository->findAllWithPagination($page, $limit);
        $jsonCustomerList = $serializer->serialize($customerList, 'json', ["groups" => "getCustomers"]);
        return new JsonResponse($jsonCustomerList, Response::HTTP_OK, [], true);

    }*/


    /** Cette méthode permet de récupérer les détails d'un client.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne les détails d'un client",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Customers::class, groups={"getCustomers"}))
     *     )
     * )
     *
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="L'ID du client que l'on veut récupérer",
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Tag(name="Customers")
     *
     * @param Customers           $customers  parameter
     * @param SerializerInterface $serializer parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/customers/{id}", name="detailCustomer", methods="GET")
     */
    /*public function getDetailCustomer(Customers $customers, SerializerInterface $serializer): JsonResponse
    {

        $jsonCustomer = $serializer->serialize($customers, 'json', ["groups" => "getCustomers"]);
        return new JsonResponse($jsonCustomer, Response::HTTP_OK, [], true);
    }*/


}
