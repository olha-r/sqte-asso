<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/about', name: 'app_')]
class AboutController extends AbstractController
{
    #[Route('/', name: 'about')]
    public function index(AboutRepository $repos): Response
    {

        return $this->render('about/index.html.twig', [
            "about" => $about = $repos->findAll()
        ]);
    }

    #[Route('/ajouter/apropos', name: 'ajouter.apropos')]
    #[Route('/updateabout/{id}/edit', name: 'edit.about')]
    public function form(
        About $about  = null,
        Request $request,
        ManagerRegistry $entityManager,

    ): Response {



        if (!$about) {
            $about = new About();
        }
        $new = true;

        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $acte = $entityManager->getManager();
            $acte->persist($about);
            $acte->flush();

            if ($new) {
                $message = "a été ajouté avec succès";
            } else {
                $message = "a été mis à jour avec succès";
            }
            $this->addFlash(type: 'success', message: $about->getTitel() .  $message);
            return $this->redirectToRoute('app_about');
        }

        return $this->render('about/ajouteractu.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $about->getId() !== null

        ]);
    }

    #[Route('/delteabout/{id}/delet', name: 'deletabout')]
    public function UpdatActu(
        About $about = null,
        ManagerRegistry $entityManager,
    ): Response {

        if ($about) {
            $em = $entityManager->getManager();
            $em->remove($about);
            $em->flush();
            $this->addFlash(type: 'success', message: " 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_about');
        } else {
            $this->addFlash(type: 'error', message: " 'Article inexistante ");
        }


        return $this->redirectToRoute(route: 'app_about');
    }

    #[Route('/apropos', name: 'apropos.about')]
    public function show(AboutRepository $repos): Response
    {

        return $this->render('about/apropos.html.twig', [
            "about" => $about = $repos->findAll()
        ]);
    }
}
