<?php
namespace App\Traits;

trait NotificationMessage{

    public function getNotificationMessage($mesage,$type){
        return [
            'messege' => $mesage,
            'alert' => $type
        ];
    }


}


?>
