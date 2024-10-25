<?php

namespace App\Controller;

use App\Entity\NesletterCategorie;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Entity\UserNewsletter;
//use App\Service\NewsletterService;
use App\Repository\NewsletterRepository;
use App\Repository\UserNewsletterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsletter', name: 'app_')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(NewsletterRepository $repos): Response
    {
        return $this->render('newsletter/list.html.twig', [
            'newsletter' => $repos->findAll()
        ]);
    }


    #[Route('/send/{id}', name: 'send')]
    public function send(Newsletter $newsletter,
     UserNewsletterRepository $repos,  MailerInterface $mailer ): Response  //,NewsletterService $newsletterService
    {
        
        $abonnes =$repos->findAll();
 
        // $users = new UserNewsletter();
        // $users = $newsletter->$inscri->;
 
       // $newsletter = $this->renderView('newsletter/contenu.html.twig',[
         //'articles' => $newsletter,
        //]);
         foreach( $abonnes as  $users){
             $email = $users->getEmail();
            // $newsletterService->sendNewsletter($email, 'Nouvelles du mois',   $newsletter);
           // $emailContent = "Bonjour " .  $users->getEmail() . ", voici notre dernière newsletter...";
              $email = (new TemplatedEmail())
             ->from('contact@sqteofficiel.com')
             ->to($users->getEmail())
              ->subject($newsletter->getTitle())
             ->htmlTemplate('message/newsletter.html.twig')
              ->context(compact('newsletter', 'users'))
 
              ;
             $mailer->send(($email));
         }
         
         return $this->render('newsletter/list.html.twig', [
            
         ]);
    }

    #[Route('/unsubscribe/{id}/{newsletter}/{token}', name: 'unsubscribe')]
    public function desincrit(Newsletter $newsletter,
     UserNewsletter $users, $token,
     ManagerRegistry $entityManager)
    {
        if($users->getValidationToke() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }
         $em = $entityManager->getManager();
            $em->remove($users);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Newsletter supprimé avec succès ");
            return $this->redirectToRoute('home'); 

    }

    #[Route('/prepare', name: 'prepare')]
    #[Route('/prepare/edit/{id}/update', name: 'edit.prepare')]
    public function prepare(Request $request,
    ManagerRegistry $entityManager, Newsletter  $newsletter = null): Response
    {
        
        if(!$newsletter){
            $newsletter = new Newsletter();
         
           }
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em = $entityManager->getManager();
            $em->persist($newsletter);
            $em->flush();
            return $this->redirectToRoute('app_list');
           }
        
        return $this->render('newsletter/prepare.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $newsletter->getId() !== null
        ]);
    }

    
}
