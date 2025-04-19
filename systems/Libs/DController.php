<?php
     // Use __DIR__ for a reliable relative path
    class DController {

        protected $load;
        protected $privateModel;
        protected $homeModel;

        public function __construct() {
           
            $this->load = new Load();
            
        }

        protected function getHeaderData() {
            // Lấy thông tin admin từ session
            $adminId = Session::get('Admin_Id');
            if (!$adminId) return array();

            // Load models nếu chưa được load
            if (!$this->privateModel) {
                $this->privateModel = $this->load->model('PrivateModel');
            }
            if (!$this->homeModel) {
                $this->homeModel = $this->load->model('HomeModel');
            }

            // Lấy thông tin admin và danh sách lớp
            $adminInfo = $this->privateModel->getAdminInfoForHeader($adminId);
            $classList = $this->homeModel->listClass('tbl_object');

            return array(
                'admin' => (object)$adminInfo,
                'list' => $classList
            );
        }
    }
?>