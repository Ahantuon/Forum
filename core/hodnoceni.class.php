<?php
  class hodnoceni extends db{
    public function hodnoceni($connection){
      $this->connection = $connection;
    }
    public function InsertHodnoceni($hodnoceni){
      $table_name = "hodnoceni";
      $this->DBInsert($table_name, $hodnoceni);
    }
    public function DeleteHodnoceniByID($hodnoceni_id){
      $table_name = "hodnoceni";
      $where_array[] = array("column" => "idhodnoceni", "value" => $hodnoceni_id, "symbol" => "=");
      $this->DBDeleteOne($table_name, $where_array);
    }
    public function LoadAllHodnoceni(){
      $table_name = "hodnoceni";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $hodnoceni = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      return $hodnoceni;
    }
  }
?>