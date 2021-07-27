<?php

namespace App\Controller;

use App\Entity\Gym;
use App\Form\GymType;
use App\Repository\GymRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gym")
 */
class GymController extends AbstractController
{
    /**
     * @Route("/", name="gym_index", methods={"GET"})
     */
    public function index(GymRepository $gymRepository): Response
    {
        return $this->render('gym/index.html.twig', [
            'gyms' => $gymRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gym_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gym = new Gym();
        $form = $this->createForm(GymType::class, $gym);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gym);
            $entityManager->flush();
            

            return $this->redirectToRoute('gym_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gym/new.html.twig', [
            'gym' => $gym,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gym_show", methods={"GET"})
     */
    public function show(Gym $gym): Response
    {
        return $this->render('gym/show.html.twig', [
            'gym' => $gym,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gym_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Gym $gym): Response
    {
        $form = $this->createForm(GymType::class, $gym);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gym_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gym/edit.html.twig', [
            'gym' => $gym,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gym_delete", methods={"POST"})
     */
    public function delete(Request $request, Gym $gym): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gym->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gym);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gym_index', [], Response::HTTP_SEE_OTHER);
    }
}
