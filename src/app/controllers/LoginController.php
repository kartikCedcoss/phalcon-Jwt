<?php


use Phalcon\Mvc\Controller;

use Firebase\JWT\JWT;




class LoginController extends Controller
{ 
    public function indexAction()
    {
        
        
    }
    public function signupAction()
    {
    }
    public function authAction()
    {
       
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $user =  Tb_users::findFirst(['conditions' => "email = '$email' AND password = '$pass'"]);

        if ($user) {
            
            $key = "example_key";

            $payload = array(
                "iss" => "http://localhost:8080",
                "aud" => "http://localhost:8080",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "name"=>$user->name,
                "role"=>$user->userrole, 
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            

            $this->session->set('username',$user->name);
            $this->response->redirect("index?bearer=$jwt");
        }
    }
    public function registerAction()
    { 
         $name = $this->request->getPost('name');
         $role = $this->request->getPost('role');
         $user = new Tb_users();
         $user->assign([
            'name' => $name,
            'email' => $this->request->getPost('email'),
            'userrole' => $role,
            'password' => $this->request->getPost('password')

        ]);

        $success = $user->save();
        if ($success) {
            $key = "example_key";

            $payload = array(
                "iss" => "http://localhost:8080",
                "aud" => "http://localhost:8080",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "name"=>$user->name,
                "role"=>$user->userrole, 
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            $this->session->set('username',$name);
            $this->response->redirect("index?bearer=$jwt");
            
        }
    }
    public function logoutAction(){
        $this->session->destroy();
        $this->response->redirect('../login');
    }
}