<?php

namespace app\controllers;


use core\App;
use core\SessionUtils;

class PanelControl
{
    public function generateView()
    {
        echo "ELO";
    }

    public function action_panel(){
        if(SessionUtils::load("user_id")){
            $this->generateView();
        } else {
            header("Location: " . App::getConf()->app_url . "/login");
        }
    }
}