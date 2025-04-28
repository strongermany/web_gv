<?php
class HomeController extends DController
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function index()
    {
        return $this->homePage();
    }

    public function homePage()
    {
        $homemodel = $this->load->model('HomeModel');
        $privateModel = $this->load->model('PrivateModel');
        
        // Lấy dữ liệu cơ bản cho header
        $data = [
            'admin' => null,
            'list' => $homemodel->listClass('tbl_object')
        ];

        // Nếu đã đăng nhập, lấy thêm thông tin admin
        if (Session::get('login')) {
            $adminId = Session::get('Admin_Id');
            if ($adminId) {
                $adminInfo = $privateModel->getAdminInfoForHeader($adminId);
                $data['admin'] = (object)$adminInfo;
            }
        }
        
        // Lấy dữ liệu slider
        $data['sliderItems'] = $privateModel->getAllSliderItems();
        
        // Lấy dữ liệu tin tức
        $data['newsItems'] = $privateModel->getAllNews();
        
        // Lấy dữ liệu khóa học
        $data['courses'] = $privateModel->getAllCourses();
        
        // Thêm biến page cho phân trang
        $data['page'] = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $this->load->view('header', $data);
        $this->load->view('slider', $data);
        $this->load->view('timetable');
        $this->load->view('homePage', $data);
        $this->load->view('footer');
    }
}
