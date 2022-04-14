<?php

use Phalcon\Mvc\Controller;


class UserController extends Controller
{
    public function indexAction()
    {
        $name = 'Kehndi Hundi Si Chaand Tak Rah Bna de';

        $text = $this->locale->_(
            'song',
            [
                'song' => $name,
            ]
        );
        
        $this->view->text = $text;
    }
}