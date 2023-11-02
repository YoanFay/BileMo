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

class CustomersController extends AbstractController
{


    /**
     * @Route("/api/customers", name="customers", methods="GET")
     */
    public function getCustomersList(
        CustomersRepository    $customersRepository,
        SerializerInterface $serializer,
        Request             $request
    ): JsonResponse
    {

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $customerList = $customersRepository->findAllWithPagination($page, $limit);
        $jsonCustomerList = $serializer->serialize($customerList, 'json', ["groups" => "getCustomers"]);
        return new JsonResponse($jsonCustomerList, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/customers/{id}", name="detailCustomer", methods="GET")
     */
    public function getDetailCustomer(Customers $customers, SerializerInterface $serializer): JsonResponse
    {

        $jsonCustomer = $serializer->serialize($customers, 'json', ["groups" => "getCustomers"]);
        return new JsonResponse($jsonCustomer, Response::HTTP_OK, [], true);
    }


        /**
         * @Route("/api/customers", name="createCustomer", methods="POST")
         */
    public function createCustomers(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, UserPasswordHasherInterface $userPasswordHasher): JsonResponse
    {

        $customer = $serializer->deserialize($request->getContent(), Customers::class, 'json');

        $errors = $validator->validate($customer);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $customer->setPassword($userPasswordHasher->hashPassword($customer, $customer->getPassword()));

        $em->persist($customer);
        $em->flush();

        $jsonCustomer = $serializer->serialize($customer, 'json', ["groups" => "getCustomers"]);
        $location = $urlGenerator->generate('detailCustomer', ['id' => $customer->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonCustomer, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    /**
     * @Route("/api/customers/{id}", name="updateCustomer", methods="PUT")
     */
    public function updateCustomer(Request $request, SerializerInterface $serializer, Customers $currentCustomer, EntityManagerInterface $em): JsonResponse
    {

        $updatedCustomer = $serializer->deserialize(
            $request->getContent(),
            Customers::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentCustomer]
        );

        $em->persist($updatedCustomer);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }


    /**
     * @Route("/api/customers/{id}", name="deleteCustomers", methods="DELETE")
     */
     public function deleteCustomer(Customers $customers, EntityManagerInterface $em): JsonResponse
     {

         $em->remove($customers);
         $em->flush();

         return new JsonResponse(null, Response::HTTP_NO_CONTENT);
     }
}
