<?php
    class HomeModel extends DModel{
        public function __construct(){
            parent::__construct();
            echo "HomeModel class loaded<br>";
        }
        
        public function getData(){
            $data = array(
                'title' => 'Home Page',
                'content' => 'Welcome to the home page!'
            );
            return $data;
        }
    }
?>