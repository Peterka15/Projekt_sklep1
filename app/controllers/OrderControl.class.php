<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;
use core\Utils;
use Exception;

class OrderControl {

    private $records;
    private $rola;

    public function action_getOrder() {
        $id = SessionUtils::load('user_id', true);
        $query = "SELECT `koszyk`.`user_id`, `koszyk`.`produkt_id`, `koszyk`.`ilosc` as 'koszyk_ilosc', `produkty`.`nazwa`, `produkty`.`cena`, `produkty`.`ilosc`, `produkty`.`idProduktu`"
                . "FROM `koszyk` "
                . "JOIN `produkty` "
                . "ON `produkty`.`idProduktu` = `koszyk`.`produkt_id` "
                . "WHERE `koszyk`.`user_id` = $id";

        try {
            $orders = App::getDB()->query($query)->fetchAll();

            //Mapowanie tablicy
            $orders = array_map(function ($rekord) {
                //Konwertuj stringi na int/float
                $rekord['user_id'] = intval($rekord['user_id']);
                $rekord['produkt_id'] = intval($rekord['produkt_id']);
                $rekord['koszyk_ilosc'] = intval($rekord['koszyk_ilosc']);
                $rekord['nazwa'];
                $rekord['cena'] = floatval($rekord['cena']);
                $rekord['ilosc'] = intval($rekord['ilosc']);
                $rekord['idProduktu'] = intval($rekord['idProduktu']);
                 
                //Usunięcie niechcianych indeksów
                unset($rekord["0"]);
                unset($rekord["1"]);
                unset($rekord["2"]);
                unset($rekord["3"]);
                unset($rekord["4"]);

                return $rekord;
            }, $orders);
        } catch (Exception $e) {
            die('{"message": "ERROR: Exception: ' . $e->getMessage() . '"}');
        }

        //Sprawdź, czy zostały przekazane wszystkie dane

        try {

            // $id_zamowienia = "INSERT INTO `zamowienia`( `data`, `user_id`) "
            //        . "VALUES ( NOW(),$id)";
            // $pdo = App::getDB()->query($id_zamowienia);

            $database = App::getDB();
            $database->insert("zamowienia", [
                "data" => date("Y-m-d H:i:s"),
                "user_id" => $id
            ]);

            $insert_id = $database->id();

            foreach ($orders as $pozycja) {
                
                $koszyk_product_id = $pozycja['produkt_id'];
                $koszyk_product_ilosc = $pozycja['koszyk_ilosc'];
                $produkt_ilosc = $pozycja['ilosc'];
                $produkt_nazwa = $pozycja['nazwa'];
                $produkt_cena = $pozycja ['cena'];
                $produkt_id = $pozycja['idProduktu'];

                //Insert lub update
                
                $new_ilosc = $produkt_ilosc - $koszyk_product_ilosc;
                
                $update = "UPDATE `produkty` SET `ilosc` = $new_ilosc WHERE `idProduktu` = $produkt_id ";
                
                 App::getDB()->query($update);
                
                
                $query = "INSERT INTO `produkty_zamowienia` (`idProduktu`,  `cena`, `ilosc`,`nazwa`, `idZamowienia`) "
                        . "VALUES($koszyk_product_id, $produkt_cena ,$koszyk_product_ilosc, '$produkt_nazwa' ,$insert_id) ";

                
                App::getDB()->query($query);

                // INSERT i UPDATE jako jedna zmiana


                App::getDB()->query("DELETE FROM `koszyk` WHERE `user_id` = $id");
            }
        } catch (Exception $e) {
            die('{"message": "ERROR: Exception: "' . $e->getMessage() . '"}');
        }

        $this->prepareOrder();
    }

    public function action_showOrder() {
        $this->prepareOrder();
    }

    public function prepareOrder() {

        $this->login = SessionUtils::load('login', true);
        $id = SessionUtils::load('user_id', true);
        $this->rola = SessionUtils::load("rola", true);



        try {
            if (SessionUtils::load("rola", true) == 'Admin') {

                $query = "SELECT `zamowienia`.`idZamowienia`, `zamowienia`.`data`, `produkty_zamowienia`.`nazwa`,"
                        . "`produkty_zamowienia`.`idProduktu`, `produkty_zamowienia`.`cena`,`produkty_zamowienia`.`ilosc`, `uzytkownicy`.`imie`, `uzytkownicy`.`nazwisko`"
                        . "FROM `zamowienia` "
                        . "JOIN `produkty_zamowienia`"
                        . " ON `zamowienia`.`idZamowienia` = `produkty_zamowienia`.`idZamowienia` "
                        . "JOIN `uzytkownicy`"
                        . " ON `zamowienia`.`user_id` = `uzytkownicy`.`user_id`  "
                        . "ORDER BY `zamowienia`.`data`";
            } else if (SessionUtils::load("rola", true) == 'User') {

                $query = "SELECT `zamowienia`.`idZamowienia`, `zamowienia`.`data`,`produkty_zamowienia`.`nazwa`,"
                        . "`produkty_zamowienia`.`cena`,`produkty_zamowienia`.`ilosc`"
                        . "FROM `zamowienia` "
                        . "JOIN `produkty_zamowienia`"
                        . "ON `zamowienia`.`idZamowienia` = `produkty_zamowienia`.`idZamowienia`"
                        . "WHERE `zamowienia`.`user_id` = $id "
                        . "ORDER BY `zamowienia`.`data`";
                        
            } else {
                throw new Exception("bład dostępu");
            }

            $this->records = App::getDB()->query($query)->fetchAll();

            $this->generateView();
        } catch (Exception $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas pobierania rekordów');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }echo $e->getMessage();
        }
    }

    public function generateView() {

       App::getSmarty()->assign('user_id', SessionUtils::load('user_id', true));
     //  App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
        App::getSmarty()->assign('login', $this->login);  // lista rekordów z bazy danych
        App::getSmarty()->assign('rola', $this->rola);
        App::getSmarty()->assign('records', $this->records);
        App::getSmarty()->display('OrderView.tpl');
    }

}
