<?php

namespace App\Controller;



use App\Entity\Rating;

use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class RatingController extends AbstractController
{
    /**
     * @Route("/rating", name="rating")
     */
    public function index(): Response
    {
        return $this->render('rating/index.html.twig', [
            'controller_name' => 'RatingController',
        ]);
    }
     /**
     * @Route("/api/addrating", name="rating")
     */
    public function rating(Request $request ,SerializerInterface $seralizer): Response
    {
        $data = $request->getContent();
        $rating = $seralizer->deserialize($data, Rating::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($rating);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($rating, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updaterating/{id}", name="Rating_put", methods={"PUT"})
     */
    public function putRating(
        Rating $rating,
        \Symfony\Component\HttpFoundation\Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Rating::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $rating]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($rating, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
    /**
     * @Route("/api/listratings", name="rating_list")
     */
    public function getAllRatings (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Rating::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/listerating/{id}", name="listerating")
     */
    public function getrating ($id, SerializerInterface $seralizer, RatingRepository $repo): Response
    {
        $rating=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($rating,"json");
        return new Response($jsonContent);
    }
     
}
