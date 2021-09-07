<?php

namespace App\Controller\Admin;

use App\Entity\Gym;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Message;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;s

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/welcome.html.twig', [
            'user' => []
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SouleverDesBarres.com');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-edit', Article::class);
        yield MenuItem::linkToCrud('Gym', 'fas fa-heart', Gym::class);
        yield MenuItem::linkToCrud('Room', 'fas fa-comment', Room::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-folder-open', Message::class);



    }
}
