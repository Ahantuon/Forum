<?php
  class clanek extends db{
    public function clanek($connection){
      $this->connection = $connection;
    }
    public function InsertClanek($clanek){
      $table_name = "clanek";
      $this->DBInsert($table_name, $clanek);
    }
    public function UpdateClanek($nazev, $obsah, $clanek_id){
      $table_name = "clanek";
      $where_array[] = array("column" => "idclanek", "value" => $clanek_id, "symbol" => "=");
      $set_array[0] = array("column" => "nazev", "value" => $nazev);
      $set_array[1] = array("column" => "obsah", "value" => $obsah);
      $this->DBUpdate($table_name, $set_array, $where_array);
    }
    public function GetClanekByID($clanek_id){
      $table_name = "clanek";
      $select_columns_string = "*";
      $where_array[] = array("column" => "idclanek", "value" => $clanek_id, "symbol" => "=");
      $limit_string = "";
      $clanky = $this->DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string);
      return $clanky;
    }
    public function DeleteClanekByID($clanek_id){
      $table_name = "clanek";
      $where_array[] = array("column" => "idclanek", "value" => $clanek_id, "symbol" => "=");
      $this->DBDeleteOne($table_name, $where_array);
    }
    public function LoadAllClanky(){
      $table_name = "clanek";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $clanky = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      return $clanky;
    }
  }
?>
