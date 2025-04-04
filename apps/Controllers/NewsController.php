<?php
class NewsController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        return $this->category();
    }
    public function category()
    {

        $this->load->view('header');
        $this->load->view('slider');
        $this->load->view('mainBlog');
        $this->load->view('footer');
    }

    public function detailPost(){
        $this->load->view('header');
        // $this->load->view('slider');
        $this->load->view('detailPost');
        $this->load->view('footer');
    }
  
}
