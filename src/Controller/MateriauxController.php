<?php

namespace App\Controller;

use App\Entity\Materiels;
use App\Repository\MaterielsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class MateriauxController extends AbstractController
{
    /**
     * @Route("/materiaux", name="materiaux")
     */
    public function index(): Response
    {
        return $this->render('materiaux/index.html.twig', [
            'controller_name' => 'MateriauxController',
        ]);
    }
     /**
     * @Route("/api/addmateriel", name="addmateriel")
     */
    public function addmateriel(Request $request ,SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $materiel = $serializer->deserialize($data, Materiels::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($materiel);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $serializer->serialize($materiel, "json");
        return new Response($jsonContent);
    }
      /**
     * @Route("/api/updmateriel/{id}", name="aupdmateriel_put", methods={"PUT"})
     */
    public function putmateriel(
        Materiels $materiel,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Materiels::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $materiel]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($materiel, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }   
     /**
     * @Route("/api/deletmateriel/{id}", name="deletmateriel")
     */
    public function deletmateriel($id, SerializerInterface $seralizer, MaterielsRepository $repo): Response
    {
        $materiel = $repo->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($materiel);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($materiel, "json");
        return new Response($jsonContent);
    }   
     /**
     * @Route("/api/listemateriels", name="listemateriels")
     */
    public function getmateriels(SerializerInterface $seralizer): Response
    {
        $list = $this->getDoctrine()->getRepository(Materiels::class)->findAll();
        $jsonContent = $seralizer->serialize($list, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/listemateriel/{id}", name="listemateriel")
     */
    public function getmateriel($id, SerializerInterface $seralizer, MaterielsRepository $repo): Response
    {
        $materiel = $repo->find($id);
        $jsonContent = $seralizer->serialize($materiel, "json");
        return new Response($jsonContent);
    }
     
}
