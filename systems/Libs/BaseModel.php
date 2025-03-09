<?php
    class BaseModel{

        protected $db = array();
        
        public function __construct(){
            $this->db = new DataBase();

        }
    }

?>