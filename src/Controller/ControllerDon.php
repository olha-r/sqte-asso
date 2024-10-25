<?php

namespace App\Controller;

use App\Entity\Soutien;
use App\Repository\SoutienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/aider', name: 'app_')]
class ControllerDon extends AbstractController
{
    #[Route('/', name: 'aider')]
    public function index(SoutienRepository $repos, SessionInterface $session): Response
    {

        $don = $session->get('don', []);

        $soutien = [];
        foreach($don as $id => $quantity) {
            $soutien[] = [
              'product' => $repos->find($id),
              'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($soutien as $item) {
            $totalitem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalitem;
        }

        return $this->render('don/index.html.twig', [
           'items' => $soutien,
           'total'  => $total
        ]);
    }







    //Ajouter un panier
    #[Route('/add/{id}', name: 'aider.sqte')]
    public function indexclient($id, SessionInterface $session, Soutien $soutien)
    {



        $don = $session->get('don', []);
        if(!empty($don[$id])) {
            $don[$id]++;
        } else {
            $don[$id] = 1;
        }

        $session->set('don', $don);
        return $this->redirectToRoute("app_aider");
    }

 
    #[Route('/remove/{id}', name: 'aider.remove')]
    public function remove($id, SessionInterface $session)
    {
        $don = $session->get('don', []);

        if(!empty($don[$id])) {
            unset($don[$id]);
        }

        $session->set('dom', $don);
        return $this->redirectToRoute("app_aider");
    }

}
