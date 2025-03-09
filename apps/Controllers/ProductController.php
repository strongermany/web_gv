<?php
    class ProductController extends BaseController{
        public function __construct() {
            echo"test";
            parent::__construct();
        }

        public function details($id,$name){
            echo $id;
            echo'<pre>';
            echo $name;
        }

        public function test(){
            echo 'test';
        }
    }
?>