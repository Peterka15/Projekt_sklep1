<?php

namespace app\controllers;

use app\forms\LoginForm;
use core\App;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;


class LoginControl
{
    public $form;
    public $accountData;


    public function __construct()
    {
        $this->form = new LoginForm();
    }

    public function action_login()
    {
        $this->action_getLoginParams();
        $this->generateView();
    }

    public function action_getLoginParams()
    {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->password = ParamUtils::getFromRequest('password');
        var_dump($this->form);
    }

    public function generateView()
    {
        if ($this->validateLogin()) {
            SessionUtils::store("idPracownika", $this->accountData["idPracownika"]);
            SessionUtils::store("login", $this->accountData["login"]);
            SessionUtils::store("Stanowisko", $this->accountData["Stanowisko"]);


            RoleUtils::addRole($this->accountData["Stanowisko"]);

            Utils::addInfoMessage("Logowanie udane!");

            header("Location: " . App::getConf()->app_url . "/panel");
        } else {
            App::getSmarty()->assign('page_title', 'Zaloguj się');
            App::getSmarty()->display('SignInView.tpl');
        }
    }

    public function validateLogin()
    {
        echo __FUNCTION__;
        if (!empty(SessionUtils::load("idPracownika", true))) return true;


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

        if (App::getMessages()->isError()) return false;

        try {
            $this->accountData = App::getDB()->get("pracownicy",
                 [
                    'idPracownika',
                    'Stanowisko',
                    'Imie',
                    'Nazwisko'
                ], [
                    'login' => $this->form->login,
                    'haslo' => ($this->form->password)
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

    public function action_logout()
    {
        RoleUtils::removeRole("logged");
        SessionUtils::remove("id");
        SessionUtils::remove("login");
    }
}