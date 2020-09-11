<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('login'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('login', 'LoginControl');
Utils::addRoute('getLoginParams', 'LoginControl' );
Utils::addRoute('panel', 'PanelControl' );
//Utils::addRoute('action_name', 'controller_class_name');