<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Service\UploaderService;
use App\Repository\ServiceRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MentioLegalesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/nos/srevice', name: 'app_')]
class NosSreviceController extends AbstractController
{
    #[Route('/', name: 'nos_srevice')]
    public function index(ServiceRepository $repos): Response
    {
        return $this->render('nos_srevice/index.html.twig', [
          $service = $repos->findAll()
        ]);
    }

    #[Route('/ajouter/add', name: 'add.service')]
    #[Route('/update/{id}/edit', name: 'edit')]
    public function form(
        Service $service  = null,
        Request $request,
        ManagerRegistry $entityManager,
        UploaderService $uploaderService
    ): Response {

        //$new = false;

        if(!$service) {
            $service = new Service();

        }
        $new = true;

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // if(! $service->getId()){
            //  $service->setCreatedAt( new \DateTimeImmutable());
            //}
            //  $act->setSlug($act->getTitle());
            $imageFile =  $form->get('image')->getData();
            if ($imageFile) {
                $derectory =  $this->getParameter('galerie_directory');
                $service->setImage($uploaderService->UploaderFile($imageFile, $derectory));
            }

            $acte = $entityManager->getManager();
            $acte->persist($service);
            $acte->flush();

            if($new) {
                $message = "a été ajouté avec succès";
                // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            } else {
                $message = "a été mis à jour avec succès";
                // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message: $service->getTitel() . $message);
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('nos_srevice');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
        }


        return $this->render('nos_srevice/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $service->getId() !== null

        ]);
    }




    #[Route('/delete/{id}/delet', name: 'delete')]
    public function UpdatActu(
        Service $service = null,
        ManagerRegistry $entityManager,
    ): Response {

        if($service) {
            $em = $entityManager->getManager();
            $em->remove($service);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('admin_actu');

        } else {
            $this->addFlash(type: 'error', message:" 'Personne inexistante ");
        }


        return $this->redirectToRoute(route: 'nos_srevice');

    }

    #[Route('/show', name: 'show_nos_srevice')]
    public function show(ServiceRepository $repos): Response
    {
        return $this->render('nos_srevice/show.html.twig', [
          "service" => $service = $repos->findAll()
        ]);
    }
}
