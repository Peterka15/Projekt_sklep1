<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('login'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('login', 'LoginControl');
Utils::addRoute('logout', 'LoginControl');
Utils::addRoute('getLoginParams', 'LoginControl' );
Utils::addRoute('panel', 'PanelControl', ['Admin', 'User'] );
Utils::addRoute('supplyList', 'SupplyEditControl', ['Admin'] );
Utils::addRoute('supplyNew', 'SupplyEditControl', ['Admin', 'User']  );
Utils::addRoute('supplyEdit',    'SupplyEditControl', ['Admin', 'User']	);
Utils::addRoute('supplySave',    'SupplyEditControl', ['Admin']	);
Utils::addRoute('supplyDelete',  'SupplyEditControl', ['Admin'] );
Utils::addRoute('cartGet',    'CartAPI');
Utils::addRoute('cartPost',  'CartAPI');
Utils::addRoute('getOrder', 'OrderControl');
Utils::addRoute('showOrder', 'OrderControl');


//Utils::addRoute('action_name', 'controller_class_name');