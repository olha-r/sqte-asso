<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/atelier', name: 'app_')]
class AtelierController extends AbstractController
{
    #[Route('/musique', name: 'ateliercinema')]
    public function AtelierMusique(AtelierRepository $repository): Response
    {
       
        $atelier = $repository->findBy(['categorieAtelier' => '2'],1);
        return $this->render('atelier/musique.html.twig', [
            'atelier' => $atelier,
        ]);
    }

    #[Route('/radio', name: 'ateliercinema')]
    public function AtelierRadio(AtelierRepository $repository): Response
    {
       // $entreprise_1 = $entrepriseRepository->findBy(['categorie' => '1'], ['id' => 'DESC'], 1);
        $atelier = $repository->findBy(['categorieAtelier' => '3'],['id' => 'DESC'], 1);
        return $this->render('atelier/radio.html.twig', [
            'atelier' => $atelier,
        ]);
    }


    #[Route('/cinema', name: 'ateliercinema')]
    public function AtelierCinema(AtelierRepository $repository): Response
    {
        
        $atelier = $repository->findBy(['categorieAtelier' => '1'],['id' => 'DESC'], 1);
        return $this->render('atelier/cinema.html.twig', [
            'atelier' => $atelier,
        ]);
    }


    #[Route('/mao', name: 'mao.app')]
    public function AtelierMusiquesmao(AtelierRepository $repository): Response
    {
        $mao = $repository->findBy(['categorieAtelier' => '2'],['id' => 'DESC'], 1);
        return $this->render('atelier/musiquemao.html.twig', [
            'ateliermo' =>$mao,
          
        ]);
    }

    #[Route('/batterie', name: 'batterie')]
    public function AtelierMusiquesbat(AtelierRepository $repository): Response
    {
        
        $batterie = $repository->findBy(['categorieAtelier' => '4'],['id' => 'DESC'], 1);
        return $this->render('atelier/musiquebat.html.twig', [
            'atelierbat' =>  $batterie
        ]);
    }





    #[Route('/{id<\d+>}', name: 'detail.musique')]
    public function AtelierMusiqueByOne(Atelier $atelier = null): Response
    {
        
        if(!$atelier){
            $this->addFlash( type:'error',message: "La personne d'id  n'existe pas");
      
            return $this->redirectToRoute('detail');
        }
        
        return $this->render('atelier/musiquebyone.html.twig', [
            'atelier' => $atelier,
        ]);
    }



    #[Route('/{id<\d+>}', name: 'detail.radio')]
    public function AtelieRadioByOne(Atelier $atelier = null): Response
    {
        
        if(!$atelier){
            $this->addFlash( type:'error',message: "La personne d'id  n'existe pas");
      
            return $this->redirectToRoute('detail');
        }
        
        return $this->render('atelier/radiobyone.html.twig', [
            'atelier' => $atelier,
        ]);
    }

    
    #[Route('/{id<\d+>}', name: 'detail.cinema')]
    public function AtelieCinemaByOne(Atelier $atelier = null): Response
    {
        
        if(!$atelier){
            $this->addFlash( type:'error',message: "La personne d'id  n'existe pas");
      
            return $this->redirectToRoute('detail');
        }
        
        return $this->render('atelier/cinemabyone.html.twig', [
            'atelier' => $atelier,
        ]);
    }

    

    
}
