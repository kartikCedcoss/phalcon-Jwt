<?php



namespace App\Console;

use Orders;
use Phalcon\Cli\Task;

class FetchorderTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function fetchAction(){
        $orders = Orders::find([
            'order' => 'order_id DESC',
            'limit' => 5,
        ]);
       foreach($orders as $order){
           echo "order_id=".$order->order_id." Customer_name=".$order->cname." Product=".$order->product." Quantity=".$order->quantity;
           echo "\n";
       }
    }
}