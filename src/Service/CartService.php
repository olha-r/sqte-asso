<?php

namespace App\Service;

use App\Repository\SoutienRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    protected $session;
    protected $repos;

    public function __construct( $session, SoutienRepository $repos)
    {
      $this->session = $session;  
      $this->repos = $repos;
    }


    public function add(int $id) {

        $don = $this->session->get('don', []);
        if(!empty($don[$id])){
            $don[$id] ++;
        }else{
            $don[$id] = 1;
        }

        $this->session->set('don', $don);
    }


    public function remove (int $id) {


        $don = $this->session->get('don', []);

        if(!empty($don[$id])){
            unset($don[$id]);
        }

        $this->session->set('dom',$don);
     }



    public function getFullCart() : array {
        $don = $this->session->get('don', []);

        $soutien = [];
        foreach($don as $id => $quantity){
          $soutien[] = [
            'product' => $this->repos->find($id),
            'qunatity' => $quantity
          ];
        }

        return $soutien;

    }

    public function getTotal() : float {

        $total = 0;
      
        foreach( $this->getFullCart() as $item){
            
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }

   

}