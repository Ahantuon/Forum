<?php
  class uzivatel extends db{
    public function uzivatel($connection){
      $this->connection = $connection;
    }
    public function InsertUzivatel($uzivatel){
      $table_name = "uzivatel";
      $this->DBInsert($table_name, $uzivatel);
    }
    public function UpdateUzivatel($login, $heslo, $uzivatel_id){
      $table_name = "uzivatel";
      $where_array[] = array("column" => "id", "value" => $uzivatel_id, "symbol" => "=");
      $set_array[0] = array("column" => "login", "value" => $login);
      $set_array[1] = array("column" => "heslo", "value" => $heslo);
      $this->DBUpdate($table_name, $set_array, $where_array);
    }
    public function GetUzivatelByLogin($uzivazel_login){
      $table_name = "uzivatel";
      $select_columns_string = "*";
      $where_array[] = array("column" => "login", "value" => $uzivazel_login, "symbol" => "=");
      $limit_string = "";
      $uzivatel = $this->DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string);
      return $uzivatel;
    }
    public function GetUzivatelByID($uzivazel_id){
      $table_name = "uzivatel";
      $select_columns_string = "*";
      $where_array[] = array("column" => "id", "value" => $uzivazel_id, "symbol" => "=");
      $limit_string = "";
      $uzivatel = $this->DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string);
      return $uzivatel;
    }
    public function DeleteUzivatelByID($uzivazel_id){
      $table_name = "uzivatel";
      $where_array[] = array("column" => "id", "value" => $uzivazel_id, "symbol" => "=");
      $this->DBDeleteOne($table_name, $where_array);
    }
    public function LoadAllUzivatele(){
      $table_name = "uzivatel";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $uzivatele = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      return $uzivatele;
    }
  }
?>
