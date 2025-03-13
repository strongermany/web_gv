<?php
    class OrderController extends BaseController{
        public function __construct() {
            parent::__construct();
            Session::checkSession();
        }
        public function index(){
            return $this->order();
        }
        public function order(){
          
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/order/orderHandel');
            $this->load->view('cpanel/footer');
        }
        public function addOrder(){
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/order/addOrder');
            $this->load->view('cpanel/footer');

        }

    } 

?>