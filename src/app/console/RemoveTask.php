<?php



namespace App\Console;

use Phalcon\Cli\Task;

class RemoveTask extends Task
{
    public function mainAction()
    {
        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function removelogAction($log){
         $status = unlink(APP_PATH."/logs/$log.log");
         if($status){
             echo $log.".log file deleted successfully";
         }
    }
    public function removeaclAction(){
        $status = unlink(APP_PATH."/security/acl.cache");
         if($status){
             echo "acl file deleted successfully";
         }
    }
}