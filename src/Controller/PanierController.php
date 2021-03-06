<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
    /**
     * @Route("/api/listpaniers", name="panier_list")
     */
    public function getAllPaniers (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Panier::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/panier/{id}", name="panier_detail")
     */
    public function getPanier ($id, SerializerInterface $seralizer, PanierRepository $repo): Response
    {
        $panier=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($panier,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addpanier", name="panier_add")s
     */
    public function addPanier (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $panier =$serializer -> deserialize ($data, Panier::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($panier);
        $em ->flush();
    }
    /**
     * @Route("/api/deletpanier/{id}", name="panier_delete")
     */
    public function deletePanier ($id, SerializerInterface $seralizer, PanierRepository $repo): Response
    {
        $panier = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($panier);
        $em->flush();
        $jsonContent = $seralizer->serialize($panier, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updatepanier", name="panier_update")
     */
    public function updatePanier ($id, Request $request, SerializerInterface $seralizer, PanierRepository $repo): Response
    {
        $panier = $repo->find($id);
        $data = $request->getContent();
        $panier = $seralizer->deserialize($data, Panier::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $seralizer->serialize($panier, "json");
        return new Response($jsonContent);
    }
}
