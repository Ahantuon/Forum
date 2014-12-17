<?php
  class prispevek extends db{
    public function prispevek($connection){
      $this->connection = $connection;
    }
    public function InsertPrispevek($prispevek){
      $table_name = "prispevek";
      $this->DBInsert($table_name, $prispevek);
    }
    public function DeletePrispevekByID($prispevek_id){
      $table_name = "prispevek";
      $where_array[] = array("column" => "idprispevek", "value" => $prispevek_id, "symbol" => "=");
      $this->DBDeleteOne($table_name, $where_array);
      
      $table_name = "reakce";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $reakce = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      for($i = 0; $i < count($reakce); $i++){
        if($reakce[$i]["prispevek_idprispevek"] == $prispevek_id){
          $where_array[] = array("column" => "idreakce", "value" => $reakce[$i]["idreakce"], "symbol" => "=");
          $this->DBDeleteOne($table_name, $where_array);  
        }
      }
    }
    public function LoadAllPrispevky(){
      $table_name = "prispevek";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $prispevky = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      return $prispevky;
    }
  }
?>
