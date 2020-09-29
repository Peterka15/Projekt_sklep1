<?php

namespace app\controllers;

use app\controllers\LoginControl;
use core\App;
use core\SessionUtils;

class PanelControl {

    public function generateView() {
        echo "Nie posiadasz uprawnień admina";
    }

    public function action_panel() {
        if (SessionUtils::load("rola",true) == 'Admin') {
            header("Location: " . App::getConf()->app_url . "/supplyNew");
        } else if (SessionUtils::load("rola",true) == 'User') {
          //  header("Location: " . App::getConf()->app_url . "/supplyNew");
            echo "user";
        } else {
            $this->generateView();
        }
    }

}
