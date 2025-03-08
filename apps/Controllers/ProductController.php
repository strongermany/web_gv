<?php
    class ProductController extends BaseController{
        public function __construct() {
            parent::__construct();
        }

        public function details($id,$name){
            echo $id;
            echo'<pre>';
            echo $name;
        }
    }
?>