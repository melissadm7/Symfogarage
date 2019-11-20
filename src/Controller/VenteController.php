<?php

namespace App\Controller;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VenteController extends AbstractController
{
    /**
     * @Route("/vente", name="vente")
     */
    public function index(VoitureRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class);
        $voiture = $repo->findAll();

        return $this->render('vente/index.html.twig', [
            'vente' => $voiture
        ]);
    }

    /**
     * @Route("/vente/{slug}", name="vente_show")
     * 
     *@return Response 
     */

    public function show($slug, Voiture $voiture){

        //$voiture = $repo->findOneBySlug($slug);

        return $this->render('vente/show.html.twig',[
            'voiture' => $voiture
        ]);
        
    }
}
