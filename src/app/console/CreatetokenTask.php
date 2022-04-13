<?php

namespace App\Console;

use Phalcon\Cli\Task;

use Firebase\JWT\JWT;

class CreatetokenTask extends Task
{
    public function mainAction()
    {
        echo  'This is the default task and the default action' . PHP_EOL;
    }
    public function createAction($role){
       if($role == "admin"){
        $key = "example_key";

        $payload = array(
            "iss" => "http://localhost:8080",
            "aud" => "http://localhost:8080",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "name"=>"kartik",
            "role"=>"admin", 
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
       echo $jwt;
      
       
       }
       else{
        echo "Token will only generate for admin";
    } 

    }
}