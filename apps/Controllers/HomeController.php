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
        $privateModel = $this->load->model('PrivateModel');
        
        $data = $this->getHeaderData();
        $data['sliderItems'] = $privateModel->getAllSliderItems();
        
        $this->load->view('header', $data);
        $this->load->view('slider', $data);
        $this->load->view('homePage');
        $this->load->view('footer');
    }

    
}
