<?php

namespace App\Controller;

use App\Entity\MentioLegales;
use App\Form\MentioLegalesType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MentioLegalesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/mention/legale', name: 'app_')]
class MentionLegaleController extends AbstractController
{
    #[Route('/', name: 'mention_legale')]
    public function index(MentioLegalesRepository $repos): Response
    {
        return $this->render('mention_legale/index.html.twig', [
          "mention" => $mention = $repos->findAll()
        ]);
    }

    #[Route('/ajouter/men', name: 'ajouter')]
    #[Route('/updatmen/{id}/edit', name: 'edit.men')]
    public function form(
        MentioLegales $ent  = null,
        Request $request,
        ManagerRegistry $entityManager,
    ): Response {

        //$new = false;

        if(!$ent) {
            $ent = new MentioLegales();

        }
        $new = true;

        $form = $this->createForm(MentioLegalesType::class, $ent);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $acte = $entityManager->getManager();
            $acte->persist($ent);
            $acte->flush();

            if($new) {
                $message = "a été ajouté avec succès";
                // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            } else {
                $message = "a été mis à jour avec succès";
                // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message: $ent->getTitel() . $message);
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('app_mention_legale');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
        }


        return $this->render('mention_legale/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $ent->getId() !== null

        ]);
    }

    #[Route('/delteemt/{id}/delet', name: 'deleteemt')]
    public function UpdatActu(
        MentioLegales $ent = null,
        ManagerRegistry $entityManager,
    ): Response {

        if($ent) {
            $em = $entityManager->getManager();
            $em->remove($ent);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_about');

        } else {
            $this->addFlash(type: 'error', message:" 'Article inexistante ");
        }


        return $this->redirectToRoute(route: 'app_mention_legale');

    }

    #[Route('/show', name: 'show_mention_legale')]
    public function show(MentioLegalesRepository $repos): Response
    {
        return $this->render('mention_legale/show.html.twig', [
         "mention" => $mention = $repos->findAll()
        ]);
    }
}
