<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\MarqueRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class HomeController extends AbstractController
{



    private $twig;
    private $entityManager;
    /**
     * @var Serie[]
     */
    private array $series;
    /**
     * @var \App\Entity\Marque[]
     */
    private array $marques;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, MarqueRepository $marqueRepository)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $marques =  $marqueRepository->findAll();
        $this->marques = $marques;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,
        ]);
    }
    /**
     * @Route("/sari", name="home_sari")
     */
    public function index_sari(): Response
    {
        return $this->render('home/index_sari.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,
        ]);
    }

    /**
     * @Route("/clesMinute", name="clesMinute")
     */
    public function clesMinute(): Response
    {
        return $this->render('home/clesMinute.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,
        ]);
    }

    /**
     * @Route("/reparationOrdinateur", name="reparationOrdinateur")
     */
    public function reparationOrdinateur(): Response
    {
        return $this->render('home/reparationOrdinateur.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,
        ]);
    }
    /**
     * @Route("/reparationTablette", name="reparationTablette")
     */
    public function reparationTablette(): Response
    {
        return $this->render('home/reparationTablette.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }
    /**
     * @Route("/impressionTampon", name="impressionTampon")
     */
    public function impressionTampon(): Response
    {
        return $this->render('home/impressionTampon.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }


    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('home/test.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }

    /**
     * @Route("/test2", name="test2")
     */
    public function test2(): Response
    {
        return $this->render('home/test2.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }

    /**
     * @Route("/test3", name="test3")
     */
    public function test3(): Response
    {
        return $this->render('home/test3.html.twig', [
            'controller_name' => 'HomeController',
            'marques' => $this->marques,

        ]);
    }




}
