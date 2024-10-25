<?php

namespace App\Controller;

use App\Entity\Cgu;
use App\Form\CguType;
use App\Repository\CguRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cgu', name: 'app_')]
class CguController extends AbstractController
{
    #[Route('/', name: 'cgu')]
    public function index(CguRepository $repos): Response
    {

        return $this->render('cgu/index.html.twig', [
            "cgu" =>  $cgu = $repos->findAll()
        ]);
    }

    #[Route('/ajouter/cgu', name: 'cgu.ajouter')]
    #[Route('/updateacgu/{id}/edit', name: 'cgu.editer')]
    public function form(
        Cgu $cgu  = null,
        Request $request,
        ManagerRegistry $entityManager,

    ): Response {

        //$new = false;

        if (!$cgu) {
            $cgu = new Cgu();
        }
        $new = true;

        $form = $this->createForm(CguType::class, $cgu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $acte = $entityManager->getManager();
            $acte->persist($cgu);
            $acte->flush();

            if ($new) {
                $message = "a été ajouté avec succès";
            } else {
                $message = "a été mis à jour avec succès";
            }
            $this->addFlash(type: 'success', message: $cgu->getTitel() .  $message);
            return $this->redirectToRoute('app_cgu');
        }


        return $this->render('cgu/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $cgu->getId() !== null

        ]);
    }

    #[Route('/delteacgu/{id}/delet', name: 'deletecgu')]
    public function UpdatActu(
        Cgu $cgu = null,
        ManagerRegistry $entityManager,
    ): Response {

        if ($cgu) {
            $em = $entityManager->getManager();
            $em->remove($cgu);
            $em->flush();
            $this->addFlash(type: 'success', message: " 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_about');
        } else {
            $this->addFlash(type: 'error', message: " 'Article inexistante ");
        }


        return $this->redirectToRoute(route: 'app_cgu');
    }


    #[Route('/show/cgu', name: 'show.cgu')]
    public function show(CguRepository $repos): Response
    {

        return $this->render('cgu/show.html.twig', [
            "cgu" =>  $cgu = $repos->findAll()
        ]);
    }
}
