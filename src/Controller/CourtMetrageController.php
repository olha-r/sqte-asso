<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/court/metrage', name: 'app_')]
class CourtMetrageController extends AbstractController
{
    #[Route('/', name: 'court_metrage')]
    public function index(): Response
    {
        return $this->render('court_metrage/index.html.twig', [
        ]);
    }


    #[Route('/metrage/One', name: 'byOnecourt_metrage')]
    public function CourtMatrageByOne(): Response
    {
        return $this->render('court_metrage/courtOne.html.twig', [
        ]);
    }
}
