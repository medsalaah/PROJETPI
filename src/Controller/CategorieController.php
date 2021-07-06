<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
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
     * @Route("/api/updatecategorie/{id}", name="Categorie_put", methods={"PUT"})
     */
    public function putCategorie(
        Categorie $categorie,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Categorie::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $categorie]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($categorie, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
}
