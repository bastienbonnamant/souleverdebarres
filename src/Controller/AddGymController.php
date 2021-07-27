<?php

namespace App\Controller;

use App\Entity\Gym;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddGymController extends AbstractController
{
    /**
     * @Route("/add", name="add_gym")
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $gym = array_map('trim', $_POST);
            //if ($gym['stock'] == 'on') $gym['stock'] = 1;

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $gymManager = new Gym();
            $id = $gymManager->insert($gym);

            //header c'est la ou tu veux rediriger apres avoir ajouté
            header('Location:/home/index/' . $id);
        }
        return $this->render('addgym/index.html.twig');
    }
}
