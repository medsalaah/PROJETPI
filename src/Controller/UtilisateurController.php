<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class UtilisateurController extends AbstractController
{
        /**
         * @Route("/utilisateur", name="utilisateur")
         */
        public function index(): Response
        {
            return $this->render('utilisateur/index.html.twig', [
                'controller_name' => 'UtilisateurController',
            ]);
        }
         /**
         * @Route("/api/addutilisateur", name="addutilisateur")
         */
        public function addutilisateur(Request $request ,SerializerInterface $seralizer): Response
        {
            $data = $request->getContent();
            $utilisateur = $seralizer->deserialize($data, Utilisateur::class, 'json');
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            # pour afficher les erreurs
            $jsonContent = $seralizer->serialize($utilisateur, "json");
            return new Response($jsonContent);
        }
        /**
         * @Route("/api/updateutilisateur/{id}", name="Utilisateur_put", methods={"PUT"})
         */
        public function putUtilisateur(
            Utilisateur $utilisateur,
            Request $request,
            EntityManagerInterface $em,
            SerializerInterface $serializer
        ): Response
        {
            $serializer->deserialize(
                $request->getContent(),
                Utilisateur::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $utilisateur]
            );
    
            $em->flush();
    
            return new JsonResponse(
                $serializer->serialize($utilisateur, "json", ['groups' => 'get']),
                JsonResponse::HTTP_NO_CONTENT,
                [],
                true
            );
        }
         /**
         * @Route("/api/deletutilisateur/{id}", name="deletutilisateur")
         */
        public function deletutilisateur($id, SerializerInterface $seralizer, UtilisateurRepository $repo): Response
        {
            $utilisateur = $repo->find($id);
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
            # pour afficher les erreurs
            $jsonContent = $seralizer->serialize($utilisateur, "json");
            return new Response($jsonContent);
        }
        /**
         * @Route("/api/listutilisateurs", name="utilisateur_list")
         */
        public function getAllUtilisateurs (SerializerInterface $seralizer): Response
        {
            $list=$this-> getDoctrine()->getRepository(Utilisateur::class) -> findAll();
            $jsonContent=$seralizer -> serialize($list,"json", ['groups'=>'user:read']);
            return new Response($jsonContent);
        }
         /**
         * @Route("/api/listeutilisateur/{id}", name="listeutilisateur")
         */
        public function getutilisateur($id, SerializerInterface $seralizer, UtilisateurRepository $repo): Response
        {
            $utilisateur= $repo->find($id);
            $jsonContent = $seralizer->serialize($utilisateur, "json");
            return new Response($jsonContent);
        }
         
    }

