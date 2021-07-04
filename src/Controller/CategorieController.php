<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    /**
     * @Route("/api/listcategories", name="categorie_list")
     */
    public function getAllCategories (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Categorie::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/categorie/{id}", name="categorie_detail")
     */
    public function getCategorie ($id, SerializerInterface $seralizer, CategorieRepository $repo): Response
    {
        $categorie=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($categorie,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addcategorie", name="categorie_add")s
     */
    public function addCategorie (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $categorie =$serializer -> deserialize ($data, Categorie::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($categorie);
        $em ->flush();
    }
    /**
     * @Route("/api/deletcategorie/{id}", name="categorie_delete")
     */
    public function deleteCategorie ($id, SerializerInterface $seralizer, CategorieRepository $repo): Response
    {
        $categorie = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        $jsonContent = $seralizer->serialize($categorie, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updatecategorie", name="categorie_update")
     */
    public function updateCategorie($id, Request $request, SerializerInterface $seralizer, CategorieRepository $repo): Response
    {
        $categorie = $repo->find($id);
        $data = $request->getContent();
        $categorie = $seralizer->deserialize($data, Categorie::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $seralizer->serialize($categorie, "json");
        return new Response($jsonContent);
    }
}
