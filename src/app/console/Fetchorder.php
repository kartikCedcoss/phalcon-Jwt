<?php



namespace App\Console;

use Phalcon\Cli\Task;

class FetchorderTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function fetchAction(){
        
    }
}