<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\VarDumper\VarDumper;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location")
     */
    public function index(): Response
    {
        // test2
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
        ]);
    }
    /**
     * @Route("/api/addlocation", name="addlocation")
     */
    public function addlocation(Request $request ,SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $location = $serializer->deserialize($data, Location::class, "json");
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($location);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $serializer->serialize($location, "json");
        return new Response($jsonContent);
    }
      /**
     * @Route("/api/updlocation/{id}", name="aupdlocation")
     */
    public function updlocation($id, Request $request, SerializerInterface $serializer, LocationRepository $repo): Response
    {
        $location1 = $repo->find($id);
        $data = $request->getContent();
        $location = $serializer->deserialize($data, Location::class, "json");
        $location1 = $location;
        dump($location);
        #$em = $this->getDoctrine()->getManager();
        #$em->persist($location1);
        #$em->flush();
        # pour afficher les erreurs
        $jsonContent = $serializer->serialize($location1, "json");
        return new Response($jsonContent);
    }    
     /**
     * @Route("/api/deletlocation/{id}", name="deletlocation")
     */
    public function deletlocation($id, SerializerInterface $seralizer, LocationRepository $repo): Response
    {
        $location = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($location, "json");
        return new Response($jsonContent);
    }   

     /**
     * @Route("/api/listelocations", name="listelocations")
     */
    public function getlocations(SerializerInterface $seralizer): Response
    {
        $list = $this->getDoctrine()->getRepository(Location::class)->findAll();
        $jsonContent = $seralizer->serialize($list, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/listelocation/{id}", name="listelocation")
     */
    public function getlocation($id, SerializerInterface $seralizer, LocationRepository $repo): Response
    {
        $location = $repo->find($id);
        $jsonContent = $seralizer->serialize($location, "json");
        return new Response($jsonContent);
    }
}
