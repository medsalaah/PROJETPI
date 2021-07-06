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
     * @Route("/api/addmateriaux", name="addmateriaux")
     */
    public function addmateriaux(Request $request ,SerializerInterface $seralizer): Response
    {
        $data = $request->getContent();
        $materiel = $seralizer->deserialize($data, Materiels::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($materiel);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($materiel, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updatemateriel/{id}", name="Materiel_put", methods={"PUT"})
     */
    public function putMateriel(
        Materiels $materiels,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Materiels::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $materiels]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($materiels, "json", ['groups' => 'get']),
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
     * @Route("/api/listemateriaux", name="listemateriaux")
     */
    public function getmateriaux(SerializerInterface $seralizer): Response
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
