<?php


use Phalcon\Mvc\Controller;




class IndexController extends Controller
{ 
    public function indexAction()
    {
         if(!$this->session->has('username')){
             $this->response->redirect('login');
         }
    }
    public function tempAction(){
        
    }
}
