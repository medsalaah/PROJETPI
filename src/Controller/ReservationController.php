<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    /**
     * @Route("/api/listreservations", name="reservation_list")
     */
    public function getAllReservations (SerializerInterface $seralizer): Response
    {
        $list=$this-> getDoctrine()->getRepository(Reservation::class) -> findAll();
        $jsonContent=$seralizer -> serialize($list,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/reservation/{id}", name="reservation_detail")
     */
    public function getReservation ($id, SerializerInterface $seralizer, ReservationRepository $repo): Response
    {
        $reservation=$repo -> find ($id);
        $jsonContent=$seralizer -> serialize($reservation,"json");
        return new Response($jsonContent);
    }

    /**
     * @Route("/api/addreservation", name="reservation_add")s
     */
    public function addReservation (Request $request, SerializerInterface $serializer): Response
    {
        $data=$request-> getContent();
        $reservation =$serializer -> deserialize ($data, Reservation::class, 'json');
        $em =$this -> getDoctrine()->getmanager();
        $em -> persist ($reservation);
        $em ->flush();
    }
    /**
     * @Route("/api/deletreservation/{id}", name="reservation_delete")
     */
    public function deleteReservation ($id, SerializerInterface $seralizer, ReservationRepository $repo): Response
    {
        $reservation = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        $jsonContent = $seralizer->serialize($reservation, "json");
        return new Response($jsonContent);
    }
    /**
     * @Route("/api/updatereservation", name="reservation_update")
     */
    protected function updateReservation ($id, Request $request, SerializerInterface $seralizer, ReservationRepository $repo): Response
    {
        $reservation = $repo->find($id);
        $data = $request->getContent();
        $reservation = $seralizer->deserialize($data, Reservation::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $seralizer->serialize($reservation, "json");
        return new Response($jsonContent);
    }
}
