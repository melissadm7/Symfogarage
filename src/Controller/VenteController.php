<?php

namespace App\Controller;
use App\Entity\Voiture;
use App\Form\AnnonceType;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
     * Permet de créer une annonce
     * @Route("vente/new", name="vente_create")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $voiture = new Voiture();
        
        $form = $this->createForm(AnnonceType::class, $voiture);

        $form->handleRequest($request); //Parcourir la requète

        if($form->isSubmitted()&& $form->isValid()){

            foreach($voiture->getImages() as $image){
                $image->setVoiture($voiture);
                $manager->persist($image);
            }

            $manager->persist($voiture);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce {$voiture->getMarque()} a bien été enregistrée !"
            );

            return $this->redirectToRoute('vente_show',[
                'slug' => $voiture->getSlug()
            ]);
        }
        return $this->render('vente/new.html.twig',[
            'myForm' => $form->createView()
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

