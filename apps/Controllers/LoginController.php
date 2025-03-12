<?php
    class LoginController extends BaseController{
        

        public function __construct(){
            $message = array();
            parent:: __construct();
            
        }
        public function index(){
            return $this->login();
        }
        public function login() {
                   
            $this->load->view('header');
            session::init();
            if(Session::get('login')== true){
                header("Location:".Base_URL."LoginController/Dashboard");
            }
            $this->load->view('cpanel/login'); 
            $this->load->view('footer');
         }


        public function Dashboard(){
            Session::checkSession();
            $this->load->view('cpanel/dashboard');
        }
        public function authentication_login(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $table_admin = 'tbl_admin';
            $loginmodel = $this->load->model('LoginModel');
            $count = $loginmodel->login($table_admin,$username,$password);
            if($count == 0){
                $message['msg']= 'User name or password is incorrect';
                header("Location:".Base_URL."LoginController/login");
            }else{
                $result =$loginmodel->getLogin($table_admin,$username,$password);
                Session::init();
                Session::set('login',true);//check user login or not 
                Session::set('Admin_name',$result[0]['Admin_name']);
                Session::set('Admin_Id',$result[0]['Admin_Id']);
                //cho $result[0]['Admin_name'];
                // echo $result[0]['password'];
                header("Location:".Base_URL."LoginController/Dashboard");
            }
        }
        public function logout(){
            Session::init();
            Session::destroy();
            header("Location:".Base_URL."LoginController");
           
        }

    }

?>