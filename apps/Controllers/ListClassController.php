<?php 
    class ListClassController extends DController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            return $this->classById();
        }
        public function classById()
        {
    
            $homemodel = $this->load->model('HomeModel');
    
            $data['list'] = $homemodel->listClass('tbl_class_object');
    
            $this->load->view('header');
    
            $this->load->view('listClass', $data);
            $this->load->view('footer');
        }
    }



?>