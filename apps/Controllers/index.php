<?php
    class index extends BaseController{
        

        public function __construct(){
            parent:: __construct();
            
        }

        public function homePage() {
            
            $this->load->view('HomeView'); // Truyền $data vào view
        }

    }

?>