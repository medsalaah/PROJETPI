<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }
    /**
     * @Route("/api/listcommentaires", name="commentaire_list")
     */
    public function getAllCommentaires (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Commentaire::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/listcommentaire/{id}", name="listcommentaire_detail")
     */
    public function getCommentaire ($id, SerializerInterface $seralizer, CommentaireRepository $repo): Response
    {
        $commentaire=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($commentaire,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addcommentaire", name="commentaire_add")s
     */
    public function addCommentaire (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $commentaire =$serializer -> deserialize ($data, Commentaire::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($commentaire);
        $em ->flush();
    }
    /**
     * @Route("/api/deletcommentaire/{id}", name="commentaire_delete")
     */
    public function deleteCommentaire ($id, SerializerInterface $seralizer, CommentaireRepository $repo): Response
    {
        $commentaire = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaire);
        $em->flush();
        $jsonContent = $seralizer->serialize($commentaire, "json");
        return new Response($jsonContent);
    }
      /**
     * @Route("/api/updcommentaire/{id}", name="aupdcommentaire_put", methods={"PUT"})
     */
    public function putcommentaire(
        Commentaire $commentaire,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Commentaire::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $commentaire]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($commentaire, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
}
