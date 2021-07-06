<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="evenement")
     */
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }
    /**
     * @Route("/api/listevenements", name="evenement_list")
     */
    public function getAllEvenements (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Evenement::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/evenement/{id}", name="Evenement_detail")
     */
    public function getEvenement ($id, SerializerInterface $seralizer, EvenementRepository $repo): Response
    {
        $evenement=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($evenement,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addevenement", name="evenement_add")s
     */
    public function addEvenement (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $evenement =$serializer -> deserialize ($data, Evenement::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($evenement);
        $em ->flush();
    }
    /**
     * @Route("/api/deletevenement/{id}", name="evenement_delete")
     */
    public function deleteEvenement ($id, SerializerInterface $seralizer, EvenementRepository $repo): Response
    {
        $evenement = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
        $jsonContent = $seralizer->serialize($evenement, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updateevenement/{id}", name="Evenement_put", methods={"PUT"})
     */
    public function putEvenement(
        Evenement $evenement,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Evenement::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $evenement]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($evenement, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }

}
