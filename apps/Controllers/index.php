<?php
class index extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        return $this->homePage();
    }
    public function homePage()
    {

        $this->load->view('header');
        $this->load->view('slider');
        $this->load->view('HomeView');
        $this->load->view('footer');
    }

    public function category(){
        $this->load->view('header');
        $this->load->view('slider');
        // $this->load->view('categoryProduct');
        $this->load->view('footer');
    }
    public function notFound()
    {

        $this->load->view('header');
        $this->load->view('404');
        $this->load->view('footer');
    }
}
