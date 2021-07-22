<?php

namespace App\Controller;

use App\Entity\Gym;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\SearchGymType;
use App\Repository\GymRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator, GymRepository $gymRepository): Response
    {
        $data = $this->getDoctrine()
             ->getRepository(Gym::class)
             ->findby([], ['name' => 'asc']);
             
             $form = $this->createForm(SearchGymType::class, null);
             $form->handleRequest($request);
     
             if ($form->isSubmitted() && $form->isValid()) {
                 $search = $form->getData();
                 $data = $gymRepository->findSearch($search['search']);
             
                 $gym = $paginator->paginate(
                     $data, // Requête contenant les données à paginer
                     $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                     10 // Nombre de résultats par page
                 );
     
                 
                }

        $gym = $paginator->paginate(
            $data, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
      
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'gyms' =>$gym
        ]);
    
    }

    
  
}
    