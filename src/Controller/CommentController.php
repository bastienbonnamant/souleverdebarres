<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/commentaires", name="home_commentaires")
     */
    public function comment(Request $request, EntityManagerInterface $manager){
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $comment->setCreatedAt(new \Datetime());
            $manager->persist($comment);
            $manager->flush();

            return redirectToRoute('home');
        }

        
        return $this->render('home/index.html.twig', [
            
            'commentForm' =>$form->createView()
        ]);
    }
}
