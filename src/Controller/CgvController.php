<?php

namespace App\Controller;

use App\Entity\Cgv;
use App\Form\CgvType;
use App\Repository\CgvRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/cgv', name: 'app_')]
class CgvController extends AbstractController
{
    #[Route('/', name: 'cgv')]
    public function index(CgvRepository $repos): Response
    {
        return $this->render('cgv/index.html.twig', [
            "cgv" => $cgv = $repos->findAll()
        ]);
    }

    #[Route('/ajouter/cgvent', name: 'ajouter.cgv')]
    #[Route('/updateacgvent/{id}/edit', name: 'cgv.editer')]
    public function form(
        Cgv $cgv  = null,
        Request $request,
        ManagerRegistry $entityManager,

    ): Response {



        if (!$cgv) {
            $cgv = new Cgv();
        }
        $new = true;

        $form = $this->createForm(CgvType::class, $cgv);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $acte = $entityManager->getManager();
            $acte->persist($cgv);
            $acte->flush();

            if ($new) {
                $message = "a été ajouté avec succès";
            } else {
                $message = "a été mis à jour avec succès";
            }
            $this->addFlash(type: 'success', message: $cgv->getTitel() .  $message);
            return $this->redirectToRoute('app_cgv');
        }


        return $this->render('cgv/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $cgv->getId() !== null

        ]);
    }

    #[Route('/delteacgvent/{id}/delet', name: 'deletecgv')]
    public function delete(
        Cgv $cgv = null,
        ManagerRegistry $entityManager,
    ): Response {

        if ($cgv) {
            $em = $entityManager->getManager();
            $em->remove($cgv);
            $em->flush();
            $this->addFlash(type: 'success', message: " 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_about');
        } else {
            $this->addFlash(type: 'error', message: " 'Article inexistante ");
        }


        return $this->redirectToRoute(route: 'app_cgv');
    }

    #[Route('/cgvent/ad', name: 'cgv.show')]
    public function show(CgvRepository $repos): Response
    {
        return $this->render('cgv/show.html.twig', [
            "cgv" => $cgv = $repos->findAll()
        ]);
    }
}
