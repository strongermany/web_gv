<?php
    class Load{
        
        public function __construct(){

        }

        public function view($fileName,$data = false){
            if(is_array($data)){
                extract($data);
            }
            include 'apps/Views/'.$fileName.'.php';
        }
        public function model($fileName){
            include 'apps/Models/'.$fileName.'.php';
            return new $fileName();
        }
    }

?>