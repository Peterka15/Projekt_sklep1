<?php

namespace app\controllers;

use app\controllers\LoginControl;
use core\App;
use core\SessionUtils;

class PanelControl
{
    public function generateView()
    {
        echo "Nie posiadasz uprawnień admina";
    }

    public function action_panel(){
        if(SessionUtils::load("rola")== 'Admin'){
            header("Location: " . App::getConf()->app_url . "/supplyNew");
            
        } else {
           $this->generateView();
        }
    }
}