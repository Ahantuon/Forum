<?php
  class app{
    private $data = null;
    private $db = null;
    public function app(){
      $this->db = new db();
    }
    public function GetConnection(){
      return $this->db->GetConnection();
    }
    public function Connect(){
      $this->db->Connect();
    }
  }
?>