<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessagesController extends AbstractController
{
    /**
     * @Route("/rooms/{room}/messages/new", name="app_messages_new")
     */
    public function index(Room $room, Request $request, EntityManagerInterface $em): Response
    {

        $message = new Message;

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $message->setRoom($room);
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('app_rooms_show', ['id' => $room->getId()]);

        }
        return $this->render('messages/new.html.twig', [
            'room' => $room,
            'form' => $form->createView()
        ]);
    }
}
