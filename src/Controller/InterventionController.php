<?php

namespace App\Controller;

use App\Entity\Intervention;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterventionController extends AbstractController
{
    /**
     * @Route("/intervention", name="intervention")
     */
    public function index(): Response
    {
        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'InterventionController',
        ]);
    }


    /**
     * @Route("/listerInterventions", name="listerInterventions")
     */
    public function listerInterventions(): Response
    {
        $interventions = $this->getDoctrine()->getRepository(Intervention::class)->findAll();


        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'InterventionController',
            'controller_name' => $interventions,

        ]);
    }





}
