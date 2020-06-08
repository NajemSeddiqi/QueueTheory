<?php

class prodModel {

    private function getPdoCon() {
      $host = "mysql:host=edu-mysql.du.se;dbname=db-h17najse";
      $user = "h17najse";
      $password = "b58FWyec8bGUqs6r";
      $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        try {
            $pdoCon = new PDO($host, $user, $password, $options);
        } catch (PDOException $ex) {
            echo 'Något gick fel, försök igen: ', $ex->getMessage();
            $pdoCon = NULL;
            die();
        }
        return $pdoCon;
    }

    public function getCalcs() {
        $pdo = $this->getPdoCon();
        $stmt = $pdo->prepare("select * from data");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $products;
    }

    public function clearTable(){
      $pdo = $this->getPdoCon();
      $stmt = $pdo->prepare("delete from data");
      $stmt->execute();
      $pdo = null;
    }

    public function insertValues($values) {
        $pdo = $this->getPdoCon();
        $stmt = $pdo->prepare("call add_values('$values->ARRIVAL_RATE','$values->SERVICE_RATE','$values->LQ','$values->LS','$values->WS','$values->WQ','$values->PBUSY','$values->LE')");
//        $stmt->bindParam(1,$values->ARRIVAL_RATE);
//        $stmt->bindParam(2,$values->SERVICE_RATE);
//        $stmt->bindParam(3,$values->LQ);
//        $stmt->bindParam(4,$values->LS);
//        $stmt->bindParam(5,$values->WS);
//        $stmt->bindParam(6,$values->WQ);
//        $stmt->bindParam(7,$values->PBUSY);
//        $stmt->bindParam(8,$values->LE);
        $stmt->execute();
        $pdo = null;
    }


}

?>
