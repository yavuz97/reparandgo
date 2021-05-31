<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Serie;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PhoneController extends AbstractController
{

    private $twig;
    private $entityManager;

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
     * @Route("/serie/{id}", name="seriePhone")
     */
    public function phoneSerie($id)
    {
        $serie = $this->getDoctrine()->getRepository(Serie::class)->find($id);
        $phones = $this->getDoctrine()->getRepository(Produit::class)->findBy(['serie' => $serie,]);

        return $this->render('phone/seriePhones.html.twig', [
            'produits' => $phones,
            'marques' => $this->marques,
            'controller_name' => 'PhoneController',
        ]);
    }

    /**
     * @Route("/tout_nos_produits", name="tout_nos_produits")
     */
    public function tout_nos_produits()
    {
        $phones = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        return $this->render('phone/seriePhones.html.twig', [
            'produits' => $phones,
            'marques' => $this->marques,
            'controller_name' => 'PhoneController',
        ]);
    }


    /**
     * @Route("/produit_show/{id}", name="produit_show")
     */
    public function produit_show($id):Response
    {

        $phone = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        return $this->render('phone/show.html.twig', [
            'produit' => $phone,
            'marques' => $this->marques,
        ]);
    }





}
