<?php
    class DModel {

        protected $db ;
        
        public function __construct(){
            try {
                $connect = 'mysql:dbname=lecturer; host=127.0.0.1';
                $user='root';
                $pass ='';
                $this->db = new Database($connect,$user,$pass);
               
            } catch (PDOException $e) {
                echo "Database connection failed: " . $e->getMessage();
            }
        }
    }

?>