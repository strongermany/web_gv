<?php
class index extends DController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->homePage();
    }
    public function homePage()
    {
        $homemodel = $this->load->model('HomeModel');

        $data['list'] = $homemodel->listClass('tbl_class_object');

        // Remove var_dump and exit
        $this->load->view('header', $data);
        $this->load->view('homePage');
        $this->load->view('footer');
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
