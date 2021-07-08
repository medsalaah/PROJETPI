<?php

namespace App\Controller;

use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/api/rating", name="rating")
     */
    public function rating(Request $request ,SerializerInterface $seralizer): Response
    {
        $data = $request->getContent();
        $rating = $seralizer->deserialize($data, Materiels::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($rating);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($rating, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/updrating/{id}", name="aupdrating")
     */
    public function updrating($id, Request $request, SerializerInterface $seralizer, RatingRepository $repo): Response
    {
        $rating = $repo->find($id);
        $data = $request->getContent();
        $rating = $seralizer->deserialize($data, Materiels::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($rating, "json");
        return new Response($jsonContent);
    }       
     /**
     * @Route("/api/listemateriaux", name="listemateriaux")
     */
    public function getmateriaux(SerializerInterface $seralizer): Response
    {
        $list = $this->getDoctrine()->getRepository(Materiels::class)->findAll();
        $jsonContent = $seralizer->serialize($list, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/listerating/{id}", name="listerating")
     */
    public function getrating($id, SerializerInterface $seralizer, RatingRepository $repo): Response
    {
        $rating = $repo->find($id);
        $jsonContent = $seralizer->serialize($rating, "json");
        return new Response($jsonContent);
    }
     
}
