<?php
    class BaseModel{

        protected $db ;
        
        public function __construct(){
            $connect = 'mysql:dbname=coffee_web; host=127.0.0.1';
            $user='root';
            $pass ='';
            $this->db = new DataBase($connect,$user,$pass);

        }
    }

?>