<?php

namespace App\Controller;

use App\Entity\Documentaire;
use App\Repository\DocumentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documentaire', name: 'app_')]
class DocumentaireController extends AbstractController
{
    #[Route('/', name: 'documentaire')]
    public function index(DocumentaireRepository $repos): Response
    {


        $doc = $repos->findAll();

        return $this->render('documentaire/index.html.twig', [
            'doc' => $doc,


        ]);
    }

    #[Route('/{id<\d+>}{slug}', name: 'doclong')]
    public function doclong(Documentaire $doc): Response
    {
        return $this->render('documentaire/docurt.html.twig', [
            'doc' => $doc

        ]);
    }

    #[Route('/documentaire/courtmetrage', name: 'docourt')]
    public function docourt(): Response
    {
        return $this->render('documentaire/docurt.html.twig', [

        ]);
    }

    #[Route('/documentaire/evenement', name: 'evenement')]
    public function evenement(): Response
    {
        return $this->render('documentaire/evenement.html.twig', [

        ]);
    }


    #[Route('/documentaire/doclongone', name: 'byOneDoc')]
    public function doclongByOne(): Response
    {
        return $this->render('documentaire/doclonbyone.html.twig', [

        ]);
    }

    #[Route('/documentaire/docourtone', name: 'byOneDocurt')]
    public function docurtgByOne(): Response
    {
        return $this->render('documentaire/docurtbyone.html.twig', [

        ]);
    }

    #[Route('/documentaire/evenOne', name: 'byOnevenement')]
    public function evenementByOne(): Response
    {
        return $this->render('documentaire/evenementbyone.html.twig', [

        ]);
    }
}
