<?php

namespace App\Controller;

use App\Entity\Phones;
use App\Repository\PhonesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PhonesController extends AbstractController
{


    /**
     * @Route("/api/phones", name="phones", methods="GET")
     */
    public function getPhonesList(
        PhonesRepository    $phonesRepository,
        SerializerInterface $serializer,
        Request             $request
    ): JsonResponse
    {

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 20);

        $phoneList = $phonesRepository->findAllWithPagination($page, $limit);
        $jsonBookList = $serializer->serialize($phoneList, 'json', ['getPhones']);
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/phones/{id}", name="detailPhone", methods="GET")
     */
    public function getDetailPhone(Phones $phones, SerializerInterface $serializer): JsonResponse
    {

        $jsonBook = $serializer->serialize($phones, 'json', ['getPhones']);
        return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    }

/*
    /**
     * @Route("/api/phones", name="createPhone", methods="POST")
     */
    /*public function createPhone(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator): JsonResponse
    {

        $phone = $serializer->deserialize($request->getContent(), Phones::class, 'json');

        $errors = $validator->validate($phone);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $em->persist($phone);
        $em->flush();

        $jsonBook = $serializer->serialize($phone, 'json', ['getPhones']);
        $location = $urlGenerator->generate('detailPhone', ['id' => $phone->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonBook, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    /**
     * @Route("/api/phones/{id}", name="updatePhone", methods="PUT")
     */
    /*public function updatePhone(Request $request, SerializerInterface $serializer, Phones $currentPhone, EntityManagerInterface $em): JsonResponse
    {

        $updatedPhone = $serializer->deserialize(
            $request->getContent(),
            Phones::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentPhone]
        );

        $em->persist($updatedPhone);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }


    /**
     * @Route("/api/phones/{id}", name="deletePhone", methods="DELETE")
     */
   /* public function deletePhone(Phones $phones, EntityManagerInterface $em): JsonResponse
    {

        $em->remove($phones);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }*/
}
