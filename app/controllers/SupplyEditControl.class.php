<?php

namespace app\controllers;

use app\forms\SupplyForm;
use core\App;
use core\ParamUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;


class SupplyEditControl
{
   
    public $form;
    public $supply;

  
    public function __construct()
    {
        $this->form = new SupplyForm();
    }

    
    public function getParams(){
        $this->form->id = ParamUtils::getFromPost('idProduktu');
        $this->form->nazwa = ParamUtils::getFromPost('nazwa');
        $this->form->cena = ParamUtils::getFromPost('cena');
        $this->form->ilosc = ParamUtils::getFromPost('ilosc');
    }

   
    public function getCurrentUserData(){
        try{
            $this->supply = App::getDB()->get("produkty","*",[
                'idProduktu' => $this->form->id
            ]);
        }catch(\PDOException $e){
            Utils::addErrorMessage("Błąd połączenia z bazą danych!");
        }
    }

    
    public function validateForm(){
        $v = new Validator();
        $v->validate($this->form->nazwa,[
            'required' => true,
            'trim' => true,
            'int' => true,
            'min_length' => 3,
            'max_length' => 32,
            'required_message' => 'Wymagana jest nazwa produktu',
        ]);

        $v->validate($this->form->cena,[
            'trim' => true,
            'required' => true,
            'int' => true,
            'min' => 0,
            'max' => 200000
        ]);

        $v->validate($this->form->ilosc,[
            'trim' => true,
            'required' => true,
            'int' => true,
            'min' => 0,
            'max' => 200000
        ]);

       
        $this->checkForDuplicates();
        $this->checkIsForbidden();

        if(!App::getMessages()->isError()) return true;
        else return false;
    }

   
    public function checkForDuplicates(){
        try{
            $produktIstnieje = App::getDB()->has('produkty',[
                'nazwa' => $this->form->login,
                'idProduktu[!]' => $this->form->id
            ]);

            if($produktIstnieje) Utils::addErrorMessage("Podana nazwa produktu występuje już w sklepie");

            
        }catch(\PDOException $e){
            Utils::addErrorMessage("Błąd połączenia z bazą danych!");
        }
    }
    
    
    
    

    public function checkIsForbidden(){
        if(SessionUtils::load('role', true) == 'Klient'){
            if($this->user['id_role'] <= 2){
                Utils::addErrorMessage("Klient nie może edytować cen produktów i ich ilości");
            }

            if($this->form->id_role <= 2){
                Utils::addErrorMessage("Moderator nie może nadawać uprawnień administratora ani moderatora!");
            }
        }
    }

    /**
     *
     */
    public function updateProduct(){
        
     
        try{
            App::getDB()->update('produkty',[
                'nazwa' => $this->form->nazwa,
                'cena' => $this->form->cena,
                'ilosc' => $this->form->ilosc,
            ],[
                'idProduktu' => $this->form->id
            ]);


           
        }catch(\PDOException $e){
            Utils::addErrorMessage("Błąd połączenia z bazą danych!");
        }
    }

    /**
     *
     */
    public function generateView(){
        if($this->validateForm()) {
            $this->updateUser();
        }
        header("Location: ".App::getConf()->app_url."/manageUsers/0/edit/".$this->form->id);
    }

    /**
     *
     */
    public function action_userEdit(){
        $this->getParams();
        $this->getCurrentUserData();
        $this->generateView();
    }

}