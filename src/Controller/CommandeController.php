<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    /**
     * @Route("/api/listcommandes", name="commande_list")
     */
    public function getAllCommandes (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Commande::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json", ['groups'=>'commande:read']);
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/commande/{id}", name="commande_detail")
     */
    public function getCommande ($id, SerializerInterface $seralizer, CommandeRepository $repo): Response
    {
        $commande=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($commande,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addcommande", name="commande_add")
     */
    public function addCommande (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $commande =$serializer -> deserialize ($data, Commande::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($commande);
        $em ->flush();
    }
    /**
     * @Route("/api/deletcommande/{id}", name="commande_delete")
     */
    public function deleteCommande ($id, SerializerInterface $seralizer, CommandeRepository $repo): Response
    {
        $commande = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($commande);
        $em->flush();
        $jsonContent = $seralizer->serialize($commande, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updatecommande/{id}", name="Commande_put", methods={"PUT"})
     */
    public function putCommande(
        Commande $commande,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Commande::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $commande]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($commande, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
}
