<?php
    class DModel{

        protected $db ;
        
        public function __construct(){
            $connect = 'mysql:dbname=lecturer; host=127.0.0.1';
            $user='root';
            $pass ='';
            $this->db = new DataBase($connect,$user,$pass);

        }
    }

?>