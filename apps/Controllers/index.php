<?php
    class index extends BaseController{
        

        public function __construct(){
            parent:: __construct();
            
        }
        public function homePage() {
            $homemodel = $this->load->model('HomeModel'); 
            $data['Category'] = $homemodel->category(); // Gán dữ liệu vào biến 'category'
        
            $this->load->view('HomeView', $data); // Truyền $data vào view
        }
    }

?>