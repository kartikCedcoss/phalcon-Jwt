<?php



namespace App\Console;

use Phalcon\Cli\Task;
use Products;

class FindstockTask extends Task
{
    public function mainAction()
    {
        echo 'This is the findstock and the default action' . PHP_EOL;
    }
    public function findAction(){
        $products = Products::find([
            'conditions' => 'stock < 10',
             
        ]);
        echo $products->count();
    }
}