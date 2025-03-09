<?php
    class Database extends PDO {
        public function __construct(){
            $connect = 'mysql:dbname=coffee_web; host=127.0.0.1';
            $user='root';
            $pass ='';
            parent::__construct($connect,$user,$pass);
        }
    }

?>