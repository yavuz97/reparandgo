<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Entity\Marque;
use App\Entity\PrixInter;
use App\Entity\Produit;
use App\Entity\Serie;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/produits_deMarque/{id}", name="produits_deMarque")
     */
    public function produits_deMarque($id)
    {
        $marque = $this->getDoctrine()->getRepository(Marque::class)->find($id);
        $phones = $this->getDoctrine()->getRepository(Produit::class)->findBy([
            'marque' => $marque
        ]);


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

    /**
     * @Route("list-produits", name="list-produits")
     */
    public function listProduit(){
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        return $this->render('admin/phone/list-produits.html.twig', [
        'marques' => $this->marques,
         'produits' => $produits
        ]);
    }

    /**
     * @Route("interventions-produit/{id}", name="interventions-produit")
     */
    public function interventionProduits($id, Request  $request){
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find(10);
        $interventions = $this->getDoctrine()->getRepository(Intervention::class)->findAll();
        $prixInterventions = $this->getDoctrine()->getRepository(PrixInter::class)->findBy(['Produit' => $produit ]);
//        foreach ($interventions as $intervention){
//            $produit->addIntervention($intervention);
//            $this->entityManager->persist($produit);
//            $this->entityManager->flush();
//        }
        if( $request->get('validation') !== null  ){
            if($request->get('prix') !== null or $request->get('prix') !== ""  ){
                $id_intervention = $request->get('intervention');
                $intervention = $this->getDoctrine()->getRepository(Intervention::class)->find($id_intervention);
                $produit = $this->getDoctrine()->getRepository(Produit::class)->find($request->get('produit'));
                $prixIntervention = $this->getDoctrine()->getRepository(PrixInter::class)->findOneBy([
                   'Produit' => $produit,
                   'intervention' => $intervention
                ]);
                if($prixIntervention == null ){
                    $prixIntervention = new PrixInter();
                    $prixIntervention->setIntervention($intervention);
                    $prixIntervention->setProduit($produit);
                    $this->entityManager->persist($prixIntervention);
                    $this->entityManager->flush($prixIntervention);
                }
                $prixIntervention->setPrix( $request->get('prix') );
                $this->entityManager->persist($prixIntervention);
                $this->entityManager->flush();
            }
        }

        return $this->render('admin/phone/interventions-produit.html.twig', [
            'marques' => $this->marques,
            'produit' => $produit,
            'interventions' => $interventions,
            'prixInterventions' => $prixInterventions,
        ]);
    }






}
