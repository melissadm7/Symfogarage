<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
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
        $vente = $repo->findAll();

        return $this->render('vente/index.html.twig', [
            'vente' => $vente
        ]);
    }
}
