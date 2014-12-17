<?php
  class reakce extends db{
    public function reakce($connection){
      $this->connection = $connection;
    }
    public function InsertReakci($reakce){
      $table_name = "reakce";
      $this->DBInsert($table_name, $reakce);
    }
    public function DeleteReakceByID($reakce_id){
      $table_name = "reakce";
      $where_array[] = array("column" => "idreakce", "value" => $reakce_id, "symbol" => "=");
      $this->DBDeleteOne($table_name, $where_array);
    }
    public function LoadAllReakce(){
      $table_name = "reakce";
      $select_columns_string = "*";
      $where_array = array();
      $limit_string = "";
      $order_by_array = array();
      $reakce = $this->DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string, $order_by_array);
      return $reakce;
    }
  }
?>
