<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoomController extends AbstractController
{
    /**
     * @Route("/rooms", name="app_rooms_index")
     */
    public function index(RoomRepository $roomRepository): Response
    {
        $rooms = $roomRepository->findAll();
        return $this->render('room/index.html.twig', compact ('rooms'));
    }
    
    /**
     * @Route("/rooms/new", name="app_rooms_new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $room = new Room;
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($room);
            $em->flush();

            $this->addFlash(
                'success', 
                sprintf('Discussion créé !', $room->getName())
                //addFlash est une fonction qui permet d'ajouter un message, ici de type 'succes'
                //ensuite sprintf retourne une chaine formaté, 'discussion créé ! puis on récupère l'objet room et son nom avec getName.
            );

            return $this->redirectToRoute('app_rooms_show', ['id' => $room->getId()]);
        }

        return $this->render('room/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/rooms/{id<[0-9]+>}", name="app_rooms_show")
     */
    public function show(Room $room): Response
    {
        
        return $this->render('room/show.html.twig', compact ('room'));

    }

     /**
     * @Route("/rooms/{id<[0-9]+>}/edit", name="app_rooms_edit")
     */
    public function edit(Room $room, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();

            $this->addFlash(
                'success', 
                "Discussion bien éditée"
            );

            return $this->redirectToRoute('app_rooms_show', ['id' => $room->getId()]);
        }
        
        return $this->render('room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/rooms/{id<[0-9]+>}", name="app_rooms_delete", methods={"DELETE"})
     */
    public function delete(Room $room, EntityManagerInterface $em): Response
    {
        $em->remove($room);
        $em->flush();

        $this->addFlash('success', 'Discussion bien effacée');

        return $this->redirectToRoute('app_rooms_index');

    }


}
