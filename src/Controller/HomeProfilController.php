<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/home/profil', name: 'app_')]
class HomeProfilController extends AbstractController
{
    // #[Route('/', name: 'home_profil')]
    // public function index(Request $request): Response
    // {

    //     $session = $request->getSession();
    //     if($session->has('nbvisite')) {
    //         $nbvisite = $session->get('nbvisite') + 1;

    //     } else {
    //         $nbvisite = 1;
    //     }
    //     $session->set('nbvisite', $nbvisite);
    //     return $this->render('home_profil/index.html.twig', [

    //     ]);
    // }


    // #[Route('/todo', name: 'todo_profil')]
    // public function todo(Request $request): Response
    // {

    //     $session = $request->getSession();
    //     //Afficher notre tableau de todo
    //     // sinon je l'initialise puis j'affiche
    //     if(!$session->has('todos')) {

    //         $todos = [
    //             'achat' => 'acheter clé usb',
    //             'cours' => 'Finaliser mon cours',
    //             'correction' => 'corriger mes examens'
    //         ];

    //         $session->set('todos', $todos);
    //         $this->addFlash('info', "la liste des todos viens d'étre initialisée");
    //     }
    //     //Si j ai mon tableau de todo dans ma session je ne fait que l'afficher

    //     return $this->render('home_profil/todo.html.twig', [

    //     ]);
    // }

    // // #[Route('add/{name}/{content}', name: 'todo.add.profil', defaults:['name' => 'sf6',
    // // 'cotent' =>'sf6'])]
    // #[Route('add/{name?test}/{content?test}', name: 'todo.add.profil')]
    // public function addTodo(Request $request, $name, $content)
    // {

    //     $session = $request->getSession();
    //     //vérifier si j ai mon tableua dans la session
    //     if($session->has('todos')) {


    //         // si oui on a todos avec le mem name
    //         //afficher erreur
    //         //si non on l'ajoute on affiche un message de succés
    //         $todos = $session->get('todos');
    //         if(isset($todos[$name])) {
    //             //en cas de methode update on recuper tout la methode add en changent  la condition
    //             //if(!isset($todos[$name]))

    //             $this->addFlash('error', "la liste des todosd'id $name existe déja dans la liste");
    //         } else {

    //             //si non on l'ajoute on affiche un message de succés
    //             //pour la supprission
    //             //  on remplacent  $todos[$name] = $content; par cette methode  unser($todo[$name]);
    //             //pour la reset on met
    //             //  $session = $request->getSession();
    //             //$session->remove('todos);
    //             // apres avoir retirer tout le code
    //             $todos[$name] = $content;
    //             $this->addFlash('succes', "le todosd'id $name  a été ajouté avec succès");
    //             $session->set('todos', $todos);


    //         }

    //     } else {

    //         //si non
    //         //on afficher une erreur et on va rediriger  vers le controller index
    //         $this->addFlash('error', "la liste des todos n'est pas encore inialisée");

    //     }

    //     return $this->redirectToRoute('app_todo_profil');




    // }



    // #[Route('update/{name}/{content}', name: 'todo.update.profil')]

    // public function updateTodo(Request $request, $name, $content)
    // {

    //     $session = $request->getSession();
    //     //vérifier si j ai mon tableua dans la session
    //     if($session->has('todos')) {


    //         // si oui on a todos avec le mem name
    //         //afficher erreur
    //         //si non on l'ajoute on affiche un message de succés
    //         $todos = $session->get('todos');
    //         if(!isset($todos[$name])) {
    //             //en cas de methode update on recuper tout la methode add en changent  la condition
    //             //if(!isset($todos[$name]))

    //             $this->addFlash('error', "la liste des todosd'id $name n'existe pas dans la liste");
    //         } else {

    //             //si non on l'ajoute on affiche un message de succés
    //             //pour la supprission
    //             //  on remplacent  $todos[$name] = $content; par cette methode  unser($todo[$name]);
    //             //pour la reset on met
    //             //  $session = $request->getSession();
    //             //$session->remove('todos);
    //             // apres avoir retirer tout le code
    //             $todos[$name] = $content;
    //             $this->addFlash('succes', "le todosd'id $name  a été modifié avec succès");
    //             $session->set('todos', $todos);


    //         }

    //     } else {

    //         //si non
    //         //on afficher une erreur et on va rediriger  vers le controller index
    //         $this->addFlash('error', "la liste des todos n'est pas encore inialisée");

    //     }

    //     return $this->redirectToRoute('app_todo_profil');




    // }


    // #[Route('delete/{name}', name: 'todo.delete.profil')]

    // public function deleteTodo(Request $request, $name, $content)
    // {

    //     $session = $request->getSession();
    //     //vérifier si j ai mon tableua dans la session
    //     if($session->has('todos')) {


    //         // si oui on a todos avec le mem name
    //         //afficher erreur
    //         //si non on l'ajoute on affiche un message de succés
    //         $todos = $session->get('todos');
    //         if(!isset($todos[$name])) {
    //             //en cas de methode update on recuper tout la methode add en changent  la condition
    //             //if(!isset($todos[$name]))

    //             $this->addFlash('error', "la liste des todosd'id $name n'existe pas dans la liste");
    //         } else {

    //             //si non on l'ajoute on affiche un message de succés
    //             //pour la supprission
    //             //  on remplacent  $todos[$name] = $content; par cette methode  unser($todo[$name]);
    //             //pour la reset on met
    //             //  $session = $request->getSession();
    //             //$session->remove('todos);
    //             // apres avoir retirer tout le code
    //             unset($todos[$name]);
    //             $session->set('todos', $todos);
    //             $this->addFlash('succes', "le todosd'id $name  a été supprimé avec succès");


    //         }

    //     } else {

    //         //si non
    //         //on afficher une erreur et on va rediriger  vers le controller index
    //         $this->addFlash('error', "la liste des todos n'est pas encore inialisée");

    //     }

    //     return $this->redirectToRoute('app_todo_profil');




    // }





    // #[Route('reset', name: 'todo.reset.profil')]
    // public function resetTodo(Request $request)
    // {

    //     $session = $request->getSession();
    //     $session->remove('todos');

    //     return $this->redirectToRoute('app_todo_profil');




    // }


}
