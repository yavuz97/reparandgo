<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Serie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(CategorieCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ReparAndGo');
    }

    public function configureMenuItems(): iterable
    {


        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::section('Produits');
        yield MenuItem::linkToCrud('les produits', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Ajout phone', 'fa fa-tags', Produit::class)
            ->setAction('new' )
            ->setController(PhoneCrudController::class);


        yield MenuItem::section('Configuration');
         yield MenuItem::linkToCrud('les catégories', 'fas fa-list', Categorie::class);
         yield MenuItem::linkToCrud('les marques', 'fas fa-list', Marque::class);
         yield MenuItem::linkToCrud('les series', 'fas fa-list', Serie::class);
    }




}
