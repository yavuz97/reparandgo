<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteMapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="site_map", defaults={"_format"="xml"})
     */
    public function index(Request $request): Response
    {
        // On récupère le don d'hôte depuis l'url
        $hostname = $request->getSchemeAndHttpHost();

        // on initialise un tableau pour lister les URLs
        $urls = [];

        // on ajoute les URLs "statiques"
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('reparationOrdinateur')];
        $urls[] = ['loc' => $this->generateUrl('reparationTablette')];
        $urls[] = ['loc' => $this->generateUrl('clesMinute')];
        $urls[] = ['loc' => $this->generateUrl('security_login')];
        $urls[] = ['loc' => $this->generateUrl('registration')];
        $urls[] = ['loc' => $this->generateUrl('list-marques')];

        // on rajoute les URLs "dynamiques"
        foreach ($this->getDoctrine()->getRepository(Produit::class)->findAll() as $produit){
            $images = [
                'loc' => '/images/product_images/'. $produit->getImage(),
                'title' =>  $produit->getModel()
            ];
            $urls[] = [
                'loc' => $this->generateUrl('produit_show',[
                    'id' => $produit->getId(),
                    'nomProd' => $produit->getNomUrl()
                ]),
                'image' => $images,
                'lastmod' => $produit->getUpdatedAt()->format('Y-m-d')
            ];
        }
//        foreach ($this->getDoctrine()->getRepository(Marque::class)->findAll() as $marque){
//            foreach ($this->getDoctrine()->getRepository(Categorie::class)->findAll() as $categorie) {
//                $images = [
//                    'loc' => 'images/brand_images/'. $marque->getImage(),
//                    'title' =>  $marque->getNom()
//                ];
//                $urls[] = [
//                    'loc' => $this->generateUrl('list-produits-marque-categorie',[
//                        'id_marque' => $marque->getId(),
//                        'id_categorie' => $categorie->getId()
//                    ]),
//                    'image' => $images,
//                ];
//            }
//
//        }

//        foreach ($this->getDoctrine()->getRepository(Categorie::class)->findAll() as $categorie) {
//            $urls[] = [
//                'loc' => $this->generateUrl('list-marques-categorie',[
//                    'id' => $categorie->getId()
//                ]),
//            ];
//        }
//        foreach ($this->getDoctrine()->getRepository(Serie::class)->findAll() as $serie) {
//            $urls[] = [
//                'loc' => $this->generateUrl('seriePhone',[
//                    'id' => $serie->getId()
//                ]),
//            ];
//        }

        // Fabricationd de la réponse
        $response = new Response(
            $this->renderView('site_map/index.html.twig',[
                'urls' => $urls,
                'hostname' => $hostname
            ]), // compact('urls', 'hostname')
            200
        );
        // Ajout des ent$etes HTTP
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
