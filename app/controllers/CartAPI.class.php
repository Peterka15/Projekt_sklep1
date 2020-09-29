<?php /** @noinspection SqlResolve */


namespace app\controllers;


use core\App;
use Exception;

class CartAPI
{
    /*
     * JSON DATA:
     * {
     *      produkt_id: INT
     *      user_id: INT
     *      ilosc: INT
     *      nazwa: STRING
     *      cena: FLOAT
     * }
     */
    public function action_cartGet()
    {
        header('Content-Type: application/json');

        if (!isset($_GET) || !isset($_GET['id'])) {
            die('{"message": "ERROR: Brak indeksu"}');
        }

        $id = $_GET['id'];
        $query =
              "SELECT `koszyk`.`user_id`, `koszyk`.`produkt_id`, `koszyk`.`ilosc`, `produkty`.`nazwa`, `produkty`.`cena`"
            . "FROM `koszyk` "
            . "JOIN `produkty` "
            . "ON `produkty`.`idProduktu` = `koszyk`.`produkt_id` "
            . "WHERE `koszyk`.`user_id` = $id";

        try {
            $koszyk = App::getDB()->query($query)->fetchAll();

            //Mapowanie tablicy
            $koszyk = array_map(function ($rekord) {
                //Konwertuj stringi na int/float
                $rekord['user_id'] = intval($rekord['user_id']);
                $rekord['produkt_id'] = intval($rekord['produkt_id']);
                $rekord['ilosc'] = intval($rekord['ilosc']);
                $rekord['cena'] = floatval($rekord['cena']);

                //Usunięcie niechcianych indeksów
                unset($rekord["0"]);
                unset($rekord["1"]);
                unset($rekord["2"]);
                unset($rekord["3"]);
                unset($rekord["4"]);

                return $rekord;
            }, $koszyk);

        } catch (Exception $e) {
            die('{"message": "ERROR: Exception: ' . $e->getMessage() . '"}');
        }

        echo json_encode($koszyk);
    }

    public function action_cartPost()
    {
        header('Content-Type: application/json');

        if (!isset($_GET) || !isset($_GET['id'])) {
            die('{"message": "ERROR: Brak indeksu"}');
        }

        $user_id = $_GET['id'];
        $full = isset($_GET['full']);
        $koszyk = file_get_contents('php://input');
        $koszyk = json_decode($koszyk, true);

        //Sprawdź, czy zostały przekazane wszystkie dane
        foreach ($koszyk as $pozycja) {
            if (!isset($pozycja['produkt_id']) | !isset($pozycja['ilosc'])) {
                die('{"message": "ERROR: niekompletne dane"}');
            }
        }

        $updated = 0;

        try {
            if($full){
                App::getDB()->query("DELETE FROM `koszyk` WHERE `user_id` = $user_id");
            }

            foreach ($koszyk as $pozycja) {
                $produkt_id = $pozycja['produkt_id'];
                $produkt_ilosc = $pozycja['ilosc'];

                //Insert lub update
                $query = "INSERT INTO `koszyk` (`user_id`, `produkt_id`, `ilosc`) "
                    . "VALUES($user_id, $produkt_id, $produkt_ilosc) "
                    . "ON DUPLICATE KEY "
                    . "UPDATE `ilosc` = $produkt_ilosc";

                $pdo = App::getDB()->query($query);

                //Traktuj INSERT i UPDATE jako jedna zmiana
                $updated += ($pdo->rowCount()) ? 1 : 0;
            }
        } catch (Exception $e) {
            die('{"message": "ERROR: Exception: "' . $e->getMessage() . '"}');
        }

        echo '{"message": "OK", "updated_rows": ' . $updated . '}';
    }
    
    
    
    
}