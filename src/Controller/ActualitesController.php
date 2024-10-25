<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Commentaire;
use App\Form\ComentaireType;
use App\Repository\ActualitesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/actualites', name: 'app_')]
class ActualitesController extends AbstractController
{
    #[Route('/', name: 'actualites')]
    public function index(
        ActualitesRepository $repository,
    ): Response {

        $article = $repository->findBy([], ['id' => 'DESC']);
        return $this->render('actualites/index.html.twig', [
            'article' =>  $article,
        ]);
    }

    #[Route('/actualites/{id<\d+>}{slug}', name: 'article')]
    public function commentArticle(
        Request $request,
        ManagerRegistry $entityManager,
        Actualites $article,
        ActualitesRepository $repository
    ): Response {
        $poste = $repository->findBy([], ['id' => 'DESC'], 3);
        $commentaire = new Commentaire();
        $form = $this->createForm(ComentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setActualites($article);
            $anno = $entityManager->getManager();
            $anno->persist($commentaire);
            $anno->flush();
        }
        return $this->render('actualites/article.html.twig', [
            'commentForm' => $form->createView(),
            'article' => $article,
            'poste' =>  $poste,
        ]);
    }
}
