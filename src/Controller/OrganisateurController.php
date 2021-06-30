<?php

namespace App\Controller;

use App\Entity\Organisateur;
use App\Repository\OrganisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OrganisateurController extends AbstractController
{
    /**
     * @Route("/organisateur", name="organisateur")
     */
    public function index(): Response
    {
        return $this->render('organisateur/index.html.twig', [
            'controller_name' => 'OrganisateurController',
        ]);
    }
     /**
     * @Route("/api/addorganisateur", name="addorganisateur")
     */
    public function addorganisateur(Request $request ,SerializerInterface $seralizer): Response
    {
        $data = $request->getContent();
        $organisateur = $seralizer->deserialize($data, Organisateur::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($organisateur);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($organisateur, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/updorganisateur/{id}", name="aupdorganisateur")
     */
    public function updorganisateur($id, Request $request, SerializerInterface $seralizer, OrganisateurRepository $repo): Response
    {
        $organisateur = $repo->find($id);
        $data = $request->getContent();
        $organisateur = $seralizer->deserialize($data, Organisateu::class, 'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($organisateur, "json");
        return new Response($jsonContent);
    }    
     /**
     * @Route("/api/deletorganisateur/{id}", name="deletorganisateur")
     */
    public function deletorganisateur($id, SerializerInterface $seralizer, OrganisateurRepository $repo): Response
    {
        $organisateur = $repo->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($organisateur);
        $em->flush();
        # pour afficher les erreurs
        $jsonContent = $seralizer->serialize($organisateur, "json");
        return new Response($jsonContent);
    }   
     /**
     * @Route("/api/listeorganisateurs", name="listeorganisateurs")
     */
    public function getorganisateurs(SerializerInterface $seralizer): Response
    {
        $list = $this->getDoctrine()->getRepository(Organisateur::class)->findAll();
        $jsonContent = $seralizer->serialize($list, "json");
        return new Response($jsonContent);
    }
     /**
     * @Route("/api/listeorganisateur/{id}", name="listeorganisateur")
     */
    public function getorganisateur($id, SerializerInterface $seralizer, OrganisateurRepository $repo): Response
    {
        $organisateur = $repo->find($id);
        $jsonContent = $seralizer->serialize($organisateur, "json");
        return new Response($jsonContent);
    }
     
}
