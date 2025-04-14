<?php
class index extends DController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        return $this->login();
    }

    public function login() {
        session::init();
        if(Session::get('login')== true){
            header("Location:".Base_URL."HomeController");
        }
        $this->load->view('login'); 
        
     }


    public function Dashboard(){
        Session::checkSession();
        header("Location:".Base_URL."HomeController");
    }
    public function authentication_login(){
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        echo $username;
        echo $password;
        $table_admin = 'tbl_admin';
        $loginmodel = $this->load->model('LoginModel');
        $count = $loginmodel->login($table_admin,$username,$password);
        
        if($count == 0){
            $message['msg']= 'User name or password is incorrect';
            header("Location:".Base_URL."index");
        }else{
            $result =$loginmodel->getLogin($table_admin,$username,$password);
            Session::init();
            Session::set('login',true);//check user login or not 
            Session::set('Admin_name',$result[0]['Admin_name']);
            Session::set('Admin_Id',$result[0]['Admin_Id']);
            //cho $result[0]['Admin_name'];
            // echo $result[0]['password'];
            header("Location:".Base_URL."index/Dashboard");
        }
    }
    public function logout(){
        Session::init();
        Session::destroy();
        header("Location:".Base_URL."index");
       
    }

   
    public function classById()
    {

        $homemodel = $this->load->model('HomeModel');

        $data['list'] = $homemodel->listClass('tbl_class_object');

        $this->load->view('header');

        $this->load->view('listClass', $data);
        $this->load->view('footer');
    }
    public function notFound()
    {

        $this->load->view('header');
        $this->load->view('404');
        $this->load->view('footer');
    }
}
