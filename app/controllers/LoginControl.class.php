<?php

namespace app\controllers;

use app\forms\LoginForm;
use core\App;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;

class LoginControl {

    public $form;
    public $accountData;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function action_login() {
        $this->action_getLoginParams();
        $this->generateView();
    }

    public function action_getLoginParams() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->password = ParamUtils::getFromRequest('password');
        // var_dump($this->form);
    }

    public function generateView() {
        if ($this->validateLogin()) {
            SessionUtils::store("user_id", $this->accountData["user_id"]);
            SessionUtils::store("login", $this->form->login);
            SessionUtils::store("rola", $this->accountData["rola"]);


            RoleUtils::addRole($this->accountData["rola"]);

            Utils::addInfoMessage("Logowanie udane!");

            App::getRouter()->redirectTo('supplyNew');
        } else {
            App::getSmarty()->assign('page_title', 'Zaloguj się');
            App::getSmarty()->display('SignInView.tpl');
        }
    }

    public function validateLogin() {
        // echo __FUNCTION__;
        if (!empty(SessionUtils::load("user_id", true)))
            return true;


        $v = new Validator();
        $v->validate($this->form->login, [
            'trim' => true,
            'required' => true,
            'required_message' => 'Login jest wymagany',
        ]);

        $v->validate($this->form->password, [
            'required' => true,
            'required_message' => 'Hasło jest wymagane',
        ]);

        if (App::getMessages()->isError())
            return false;

        try {
            $this->accountData = App::getDB()->get("uzytkownicy",
                    [
                        'user_id',
                        'rola',
                        'imie',
                        'nazwisko'
                    ], [
                'login' => $this->form->login,
                'haslo' => $this->form->password
            ]);

            if (empty($this->accountData)) {
                Utils::addErrorMessage("Nieprawidłowy login lub hasło");
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            Utils::addErrorMessage("Błąd połączenia z bazą danych");
        }

        return !App::getMessages()->isError();
    }

    public function action_logout() {
        RoleUtils::removeRole("logged");
        SessionUtils::remove("id");
        SessionUtils::remove("login");
        session_destroy();
        App::getRouter()->redirectTo('login');
    }

}
