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
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class PhonesController extends AbstractController
{


    /** Cette méthode permet de récupérer l'ensemble des téléphones.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne la liste des téléphones",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Phones::class, groups={"getPhones"}))
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
     * @OA\Tag(name="Phones")
     *
     * @param PhonesRepository    $phonesRepository parameter
     * @param SerializerInterface $serializer       parameter
     * @param Request             $request          parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/phones", name="phones", methods="GET")
     */
    public function getPhonesList(
        PhonesRepository    $phonesRepository,
        SerializerInterface $serializer,
        Request             $request
    ): JsonResponse
    {

        /** @var int $page */
        $page = $request->get('page', 1);
        /** @var int $limit */
        $limit = $request->get('limit', 20);

        $phoneList = $phonesRepository->findAllWithPagination($page, $limit);
        //$jsonPhoneList = $serializer->serialize($phoneList, 'json', ["groups" => "getPhones"]);

        $context = SerializationContext::create()->setGroups(['getPhones']);
        $jsonPhoneList = $serializer->serialize($phoneList, 'json', $context);
        return new JsonResponse($jsonPhoneList, Response::HTTP_OK, [], true);

    }


    /** Cette méthode permet de récupérer les détails d'un téléphone.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne les détails d'un téléphone",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Phones::class, groups={"getPhones"}))
     *     )
     * )
     *
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="L'ID du téléphone que l'on veut récupérer",
     *     @OA\Schema(type="string")
     * )
     *
     * @OA\Tag(name="Phones")
     * @param Phones              $phones     parameter
     * @param SerializerInterface $serializer parameter
     *
     * @return JsonResponse
     *
     * @Route("/api/phones/{id}", name="detailPhone", methods="GET")
     */
    public function getDetailPhone(Phones $phones, SerializerInterface $serializer): JsonResponse
    {

        $context = SerializationContext::create()->setGroups(['getPhones']);
        $jsonPhone = $serializer->serialize($phones, 'json', $context);
        return new JsonResponse($jsonPhone, Response::HTTP_OK, [], true);
    }


}
