<?php

namespace App\Controller\Admin;

use App\Entity\Gym;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GymCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gym::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
