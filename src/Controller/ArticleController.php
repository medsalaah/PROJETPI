<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/api/addarticle", name="addarticle")
     */
    public function addarticle(Request $request ,SerializerInterface $seralizer): Response
    {
        $data = $request->getContent();
        $article = $seralizer->deserialize($data, Article::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($article, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/updarticle/{id}", name="aupdarticle")
     */
    public function updarticle($id, Request $request, SerializerInterface $seralizer, ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        $data = $request->getContent();
        $article = $seralizer->deserialize($data, Materiels::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($article, "json");
        return new Response($jsonContent);
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
