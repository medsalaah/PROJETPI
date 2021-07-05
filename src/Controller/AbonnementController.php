<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnement", name="abonnement")
     */
    public function index(): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
        ]);
    }
    /**
     * @Route("/api/listabonnements", name="abonnement_list")
     */
    public function getAllAbonnements (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Abonnement::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/abonnement/{id}", name="abonnement_detail")
     */
        public function getAbonnement ($id, SerializerInterface $seralizer, AbonnementRepository $repo): Response
    {
        $abonnement=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($abonnement,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addabonnement", name="abonnement_add")
     */
    public function addAbonnement (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $abonnement =$serializer -> deserialize ($data, Abonnement::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($abonnement);
        $em ->flush();
    }
    /**
     * @Route("/api/deletabonnement/{id}", name="abonnement_delete")
     */
    public function deleteAbonnement ($id, SerializerInterface $seralizer, AbonnementRepository $repo): Response
    {
        $abonnement = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($abonnement);
        $em->flush();
        $jsonContent = $seralizer->serialize($abonnement, "json");
        return new Response($jsonContent);
    }
      /**
     * @Route("/api/updateabonnement/{id}", name="updateabonnement_put", methods={"PUT"})
     */
    public function putabonnement(
        Abonnement $abonnement,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Abonnement::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $abonnement]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($abonnement, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
}
