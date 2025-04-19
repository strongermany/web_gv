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
            $filePath = 'apps/Models/'.$fileName.'.php';
            if (file_exists($filePath)) {
                require_once $filePath;
                if (class_exists($fileName)) {
                    return new $fileName();
                }
            }
            return false;
        }
    }

?>