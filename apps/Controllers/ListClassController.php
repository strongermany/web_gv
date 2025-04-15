<?php
    class ListClassController extends DController{
        public function construct (){
            parent::__construct();
        }
      
        public function listClass($id){
            $homemodel = $this->load->model('HomeModel');
            $data['std'] = $homemodel->stdBycalss($id);
            //var_dump($data['std']);
            $this->load->view('header', $data);
            $this->load->view('listClass',$data);
            $this->load->view('footer');
        }
    }
?>