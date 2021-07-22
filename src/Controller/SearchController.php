<?php

namespace App\Controller;

use App\Entity\Gym;
use App\Data\SearchData;
use App\Repository\GymRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/Search", name="search")
     */
    public function search(Request $request, GymRepository $gymRepository, EntityManagerInterface $em): Response
    {
        
    }
        
}
