<?php

namespace App\Controller;

use App\Entity\Fiction;
use App\Repository\FictionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cinema', name: 'app_')]
class CinemaController extends AbstractController
{
    #[Route('/', name: 'cinema')]
    public function index(FictionRepository $repos): Response
    {


        $longue = $repos->findBy(['categoriFiction' => '1'], ['id' => 'desc'], 1);
        $court = $repos->findBy(['categoriFiction' => '2'], ['id' => 'asc'], 1);
        $serie = $repos->findBy(['categoriFiction' => '3'], ['id' => 'asc'], 1);
        return $this->render('cinema/index.html.twig', [
            'longue' => $longue,
            'court' => $court,
            'serie' => $serie
        ]);
    }


    #[Route('/cinema/long', name: 'long')]
    public function LongueMetrage(FictionRepository $repos): Response
    {

        $longue = $repos->findBy(['categoriFiction' => '1'], ['id' => 'asc']);
        return $this->render('cinema/longue.html.twig', ['longue' => $longue]);
    }
   
    #[Route('/cinema/{id<\d+>}', name: 'lbyone')]
    public function LongueMetrageByOne(Fiction $longue): Response
    {

       
        return $this->render('cinema/longmetragebyOne.html.twig', ['longue' => $longue]);
    }




    #[Route('/cinema/court', name: 'court')]
    public function courMetrage(FictionRepository $repos): Response
    {

        $court = $repos->findBy(['categoriFiction' => '2'], ['id' => 'asc']);
        return $this->render('cinema/court.html.twig', ['court' => $court]);
    }

    #[Route('/cinema/{id<\d+>}/courtmetrage', name: 'court.lbyone')]
    public function CourtMetrageByOne(Fiction $court): Response
    {

        if (!$court) {
            $this->addFlash(type: 'error', message: "Le film demmandé est pas disponible dans cette page");
            return $this->redirectToRoute('app_lbyone');
        }
        return $this->render('cinema/courtrbyOne.html.twig', ['longue' => $court]);
    }




    #[Route('/cinema/serie', name: 'serie')]
    public function courtSerie(FictionRepository $repos): Response
    {

        $serie = $repos->findBy(['categoriFiction' => '3'], ['id' => 'asc'], 1);
        return $this->render('cinema/serie.html.twig', ['serie' => $serie]);
    }
    #[Route('/cinema/{id<\d+>}/serie', name: 'serie.lbyone')]
    public function SeriegeByOne(Fiction $serie): Response
    {

        if (!$serie) {
            $this->addFlash(type: 'error', message: "Le film demmandé est pas disponible dans cette page");
            return $this->redirectToRoute('app_lbyone');
        }
        return $this->render('cinema/webserie.html.twig', [
            'longue' => $serie

        ]);
    }


    #[Route('/cinema/documentaire', name: 'documentaire')]
    public function documentaire(): Response
    {
        return $this->render('cinema/documentaire.html.twig', []);
    }

    #[Route('/cinema/festivale', name: 'festivale')]
    public function festival(): Response
    {
        return $this->render('cinema/festival.html.twig', []);
    }

    #[Route('/cinema/atelier', name: 'atelier')]
    public function telier(): Response
    {
        return $this->render('cinema/atelier.html.twig', []);
    }
}
