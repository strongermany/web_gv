<?php
    class index extends DController {
        public function __construct() {
            parent::__construct();
            
        }
        public function index(){
            $this->homePage();
        }
        public function homePage(){
            //$this->load->model('HomeModel');
            $this->load->view('homePage');
        }
    }
?>