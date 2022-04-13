<?php


use Phalcon\Mvc\Controller;

use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;



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
       $signer  = new Hmac();
        
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $user =  Tb_users::findFirst(['conditions' => "email = '$email' AND password = '$pass'"]);

        if ($user) {
            
            
            $builder = new Builder($signer);

            $now        = new DateTimeImmutable();

            $issued     = $now->getTimestamp();
            $notBefore  = $now->modify('-1 minute')->getTimestamp();
            $expires    = $now->modify('+1 day')->getTimestamp();
            $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';

            // Setup
            $builder
                ->setAudience('localhost:8080')  // aud
                ->setContentType('application/json')        // cty - header
                ->setExpirationTime($expires)               // exp 
                ->setId('abcd123456789')                    // JTI id 
                ->setIssuedAt($issued)                      // iat 
                ->setIssuer('https://phalcon.io')           // iss 
                ->setNotBefore($notBefore)                  // nbf
                ->setSubject($user->userrole)   // sub
                ->setPassphrase($passphrase)                // password 
            ;

            $tokenObject = $builder->getToken();
            $token=$tokenObject->getToken();
            $this->session->set('username',$user->name);
            $this->response->redirect("index?bearer=$token");
            
             

        }
    }
    public function registerAction()
    { 
        $signer  = new Hmac();
        $user = new Tb_users();
        $user->assign([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'userrole' => $this->request->getPost('role'),
            'password' => $this->request->getPost('password')

        ]);

        $success = $user->save();
        if ($success) {
            $builder = new Builder($signer);

            $now        = new DateTimeImmutable();

            $issued     = $now->getTimestamp();
            $notBefore  = $now->modify('-1 minute')->getTimestamp();
            $expires    = $now->modify('+1 day')->getTimestamp();
            $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';

            // Setup
            $builder
                ->setAudience('localhost:8080')  // aud
                ->setContentType('application/json')        // cty - header
                ->setExpirationTime($expires)               // exp 
                ->setId('abcd123456789')                    // JTI id 
                ->setIssuedAt($issued)                      // iat 
                ->setIssuer('https://phalcon.io')           // iss 
                ->setNotBefore($notBefore)                  // nbf
                ->setSubject($user->userrole)   // sub
                ->setPassphrase($passphrase)                // password 
            ;

            $tokenObject = $builder->getToken();
            $token=$tokenObject->getToken();
            $this->session->set('username',$user->name);
            $this->response->redirect("index?bearer=$token");
            
        }
    }
    public function logoutAction(){
        $this->session->destroy();
        $this->response->redirect('../login');
    }
}