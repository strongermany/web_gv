<?php
class HomeController extends DController
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Session::get('login')) {
            header("Location:" . Base_URL . "index/login");
            exit();
        }
    }

    public function index()
    {
        return $this->homePage();
    }
    public function homePage()
    {
        $homemodel = $this->load->model('HomeModel');
        $data = $this->getHeaderData();
        
        $this->load->view('header', $data);
        $this->load->view('homePage');
        $this->load->view('footer');
    }

    
}
