<?php

namespace app\controllers;

use app\forms\SupplyForm;
use core\App;
use core\ParamUtils;
use core\SessionUtils;
use core\Utils;

class SupplyEditControl {

    private $form; //dane formularza
    private $records;
    private $login;
    private $rola;

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new SupplyForm();
        $this->login = SessionUtils::load('login', true);
    }

    public function validateSave() {
        //0. Pobranie parametrów z walidacją
        $this->form->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->form->price = ParamUtils::getFromRequest('cena', true, 'Błędne wywołanie aplikacji');
        $this->form->ammount = ParamUtils::getFromRequest('ilosc', true, 'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError())
            return false;

        // 1. sprawdzenie czy wartości wymagane nie są puste
        if (empty(trim($this->form->name))) {
            Utils::addErrorMessage('Wprowadź nazwę produktu');
        }
        if (empty(trim($this->form->price))) {
            Utils::addErrorMessage('Podaj cenę');
        }
        if (empty(trim($this->form->ammount))) {
            Utils::addErrorMessage('Podaj ilość');
        }

        if (App::getMessages()->isError())
            return false;


        return !App::getMessages()->isError();
    }

    // Walidacja danych przed zapisem (nowe dane lub edycja).

    public function action_supplyNew() {
        $this->supplyList();
        $this->generateView();
    }

    //validacja danych przed wyswietleniem do edycji

    public function supplyList() {

        try {
            $this->records = App::getDB()->select("produkty", [
                "idProduktu",
                "nazwa",
                "cena",
                "ilosc",
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
            else
                $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('user_id', SessionUtils::load('user_id', true));
        App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
        App::getSmarty()->assign('supply', $this->records);  // lista rekordów z bazy danych
        App::getSmarty()->assign('login', $this->login);  // lista rekordów z bazy danych
        App::getSmarty()->assign('rola', $this->rola);
        App::getSmarty()->display('SupplyEdit.tpl');
    }

    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'

    public function action_supplyEdit() {
        // 1. walidacja id osoby do edycji
        if ($this->validateEdit()) {

            try {
                $this->records = App::getDB()->select("produkty", [
                    "idProduktu",
                    "nazwa",
                    "cena",
                    "ilosc",
                ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
                else
                    $this->generateView();
            }


            try {
                // 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
                $record = App::getDB()->get("produkty", "*", [
                    "idProduktu" => $this->form->id
                ]);
                // 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
                $this->form->id = $record['idProduktu'];
                $this->form->name = $record['nazwa'];
                $this->form->price = $record['cena'];
                $this->form->ammount = $record['ilosc'];
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Wygenerowanie widoku
        $this->generateView();
    }

    public function validateEdit() {

        //pobierz parametry na potrzeby wyswietlenia danych do edycji
        //z widoku listy osób (parametr jest wymagany)
        $this->form->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        return !App::getMessages()->isError();
    }

    public function action_supplyDelete() {
        // 1. walidacja id osoby do usuniecia
        if ($this->validateEdit()) {

            try {
                // 2. usunięcie rekordu
                App::getDB()->delete("produkty", [
                    "idProduktu" => $this->form->id
                ]);
                Utils::addInfoMessage('Pomyślnie usunięto rekord');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Przekierowanie na stronę listy osób
        App::getRouter()->redirectTo('supplyNew');
    }

    public function action_supplySave() {

        // 1. Walidacja danych formularza (z pobraniem)
        $this->validateSave();

        // 2. Zapis danych w bazie
        try {

            //2.1 Nowy rekord
            if ($this->form->id == '') {
                //sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
                $count = App::getDB()->count("produkty");
                if ($count <= 20) {
                    App::getDB()->insert("produkty", [
                        "nazwa" => $this->form->name,
                        "cena" => $this->form->price,
                        "ilosc" => $this->form->ammount
                    ]);
                } else { //za dużo rekordów
                    // Gdy za dużo rekordów to pozostań na stronie
                    Utils::addInfoMessage('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
                    $this->generateView(); //pozostań na stronie edycji
                    exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
                }
            } else {
                //2.2 Edycja rekordu o danym ID
                App::getDB()->update("produkty", [
                    "nazwa" => $this->form->name,
                    "cena" => $this->form->price,
                    "ilosc" => $this->form->ammount
                        ], [
                    "idProduktu" => $this->form->id
                ]);
            }
            Utils::addInfoMessage('Pomyślnie zapisano rekord');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }

        // 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
        App::getRouter()->redirectTo('supplyNew');
    }

}
