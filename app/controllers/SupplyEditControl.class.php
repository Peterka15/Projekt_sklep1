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
    private $search;

    private $paginationAmount = 5;
    private $pagesAmount = 1;


    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new SupplyForm();
        $this->login = SessionUtils::load('login', true);
        $this->rola = SessionUtils::load("rola", true);
    }

    public function validateSave() {
        //0. Pobranie parametrów z walidacją
//        $this->form->id = ParamUtils::getFromPost('id', true, 'Błędne wywołanie aplikacji: id');
        $this->form->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji: name');
        $this->form->price = ParamUtils::getFromRequest('cena', true, 'Błędne wywołanie aplikacji: price');
        $this->form->ammount = ParamUtils::getFromRequest('ilosc', true, 'Błędne wywołanie aplikacji: amount');
        $this->form->wyszukiwanie = ParamUtils::getFromRequest('sf_search');

        if (App::getMessages()->isError()){
            
            return false;
        }

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

        if (App::getMessages()->isError()) {
          
            return false;
        }


        return !App::getMessages()->isError();
    }

    // Walidacja danych przed zapisem (nowe dane lub edycja).

    public function action_supplyNew() {
        $this->supplyList();
        $this->generateView();
    }

    //validacja danych przed wyswietleniem do edycji

    public function supplyList() {
        $this->form = new SupplyForm();
        $this->validateSave();
        
        $query = $this->form->wyszukiwanie;

        $page = isset($_GET['page']) ? intval($_GET['page']) : 0;

        try {
            $records = App::getDB()->query("SELECT count(`idProduktu`) FROM `produkty` WHERE `nazwa` LIKE '$query%'")->fetch()[0];
            $this->pagesAmount = ceil($records / $this->paginationAmount);

            if($page > $this->pagesAmount){
                $page = 0;
            }

            $index = $page * $this->paginationAmount;
            $limit = $index . ', ' . $this->paginationAmount;

            $this->records = App::getDB()->query("SELECT * FROM `produkty` WHERE `nazwa` LIKE '$query%' LIMIT $limit");
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
        App::getSmarty()->assign('wyszukiwanie', $this->form->wyszukiwanie);
        App::getSmarty()->assign('pagesAmount', $this->pagesAmount);
        
        App::getSmarty()->display('SupplyEdit.tpl');
    }
    
     public function action_SupplyList() {
        $this->load_data();
        App::getSmarty()->assign('searchForm', $this->form); // dane formularza (wyszukiwania w tym wypadku)
        App::getSmarty()->assign('produkty', $this->records);  // lista rekordów z bazy danych
        App::getSmarty()->display('SupplyEdit.tpl');
    }
   

    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'

    public function action_supplyEdit() {
        // 1. walidacja id osoby do edycji
         $this->form->wyszukiwanie = ParamUtils::getFromRequest('sf_search');
        if ($this->validateEdit()) ;
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
        

        $this->supplyEditView();
    }
    
    public function action_supplySearch(){
         $this->form->wyszukiwanie = ParamUtils::getFromRequest('sf_search');
   
         $this->action_supplyNew();
       
    }
    
    public function supplyEditView() {
       App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
       App::getSmarty()->display('SupplyEdition.tpl');
        
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
//                App::getDB()->update("produkty",[
//                    "zarchiwizowany" => true
//                ]);
                  
                
                App::getDB()->query("UPDATE `produkty` SET `zarchiwizowany`= true WHERE `idProduktu` = ".$this->form->id);
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
            if ($this->form->id == '' || !$this->form->id) {
                //sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
                $count = App::getDB()->count("produkty");
                if ($count <= 100) {
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
//                
//                $record = App::getDB()->get("produkty", "*", [
//                    "idProduktu" => $this->form->id
//                 ]);
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
