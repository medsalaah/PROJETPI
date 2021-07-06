<?php

namespace App\Controller;


use App\Entity\Expriences;
use App\Repository\ExpriencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experience", name="experience")
     */
    public function index(): Response
    {
        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
        ]);
    }
    /**
     * @Route("/api/listexperiences", name="experience_list")
     */
    public function getAllExperiences (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Expriences::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json", ['groups'=>'experience:read']);
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/experience/{id}", name="experience_detail")
     */
    public function getExperience ($id, SerializerInterface $seralizer, ExpriencesRepository $repo): Response
    {
        $experience=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($experience,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addexperience", name="experience_add")s
     */
    public function addExperience (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $experience =$serializer -> deserialize ($data, Expriences::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($experience);
        $em ->flush();
    }
    /**
     * @Route("/api/deletexperience/{id}", name="experience_delete")
     */
    public function deleteExperience ($id, SerializerInterface $seralizer, ExpriencesRepository $repo): Response
    {
        $experience = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($experience);
        $em->flush();
        $jsonContent = $seralizer->serialize($experience, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updateexperience", name="experience_update")
     */
    public function updateExperience($id, Request $request, SerializerInterface $seralizer, ExpriencesRepository $repo): Response
    {
        $experience = $repo->find($id);
        $data = $request->getContent();
        $experience = $seralizer->deserialize($data, Expriences::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $seralizer->serialize($experience, "json");
        return new Response($jsonContent);
    }
}
