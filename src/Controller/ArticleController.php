<?php

namespace App\Controller;



use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(): Response
    {

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    /**
     * @Route("/api/addarticle", name="article_add")
     */
    public function addArticle (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $article =$serializer -> deserialize ($data, Article::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($article);
        $em ->flush();
    }
    /**
     * @Route("/api/updatearticle/{id}", name="Article_put", methods={"PUT"})
     */
    public function putArticle(
        Article $article,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize(
            $request->getContent(),
            Article::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $article]
        );

        $em->flush();

        return new JsonResponse(
            $serializer->serialize($article, "json", ['groups' => 'get']),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }
     /**
     * @Route("/api/deletarticle/{id}", name="deletarticle")
     */
    public function deletarticle($id, SerializerInterface $seralizer, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($article, "json");
        return new Response($jsonContent);
    }   
     /**
     * @Route("/api/listearticles", name="listearticles")
     */
    public function getarticles(SerializerInterface $seralizer): Response
    {
        $list = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $jsonContent = $seralizer->serialize($list, "json", ['groups'=>'article:read']);
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/listearticle/{id}", name="listearticle")
     */
    public function getarticle($id, SerializerInterface $seralizer, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        $jsonContent = $seralizer->serialize($article, "json");
        return new Response($jsonContent);
    }
     
}
