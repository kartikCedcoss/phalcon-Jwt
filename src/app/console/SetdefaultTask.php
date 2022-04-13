<?php



namespace App\Console;

use Phalcon\Cli\Task;
use Settings;

class SetdefaultTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the setdefault action' . PHP_EOL;
    }
    public function setpricestockAction($price,$stock){
        $settings = Settings::findFirstBysid(1);
        $settings->default_price = $price;
        $settings->default_stock=$stock;
        $success = $settings->save();
        if($success){
            echo "default price and stocks are updated";

        }
        else{
            echo "error";
        }


    }
}