<?php
    class ListClassController extends DController{
        protected $attendanceModel;

        public function __construct(){
            parent::__construct();
            Session::init();
            if (!Session::get('login')) {
                header("Location:" . Base_URL . "index/login");
                exit();
            }
            $this->attendanceModel = $this->load->model('AttendanceModel');
        }
      
        public function index()
        {
            $data = $this->getHeaderData();
            $this->load->view('header', $data);
            $this->load->view('listClass');
            $this->load->view('footer');
        }

        public function listClass($id_object, $id_group){
            // Lấy dữ liệu header và danh sách lớp
            $data = $this->getHeaderData();
            
            // Lấy danh sách sinh viên của lớp
            $data['std'] = $this->attendanceModel->getStudentsByClass($id_object, $id_group);
            
            // Lấy dữ liệu điểm danh của ngày hiện tại nếu có
            $today = date('Y-m-d');
            $data['attendance'] = $this->attendanceModel->getAttendanceByDate($id_object, $id_group, $today);
            
            // Lưu ID môn học và lớp để form điểm danh sử dụng
            $data['object_id'] = $id_object;
            $data['group_id'] = $id_group;
            
            $this->load->view('header', $data);
            $this->load->view('listClass', $data);
            $this->load->view('footer');
        }

        public function saveAttendance(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy thông tin từ form
                $object_id = $_POST['object_id'];
                $group_id = $_POST['group_id'];
                $attendance_data = $_POST['attendance'];
                $date = date('Y-m-d');
                
                $success = true;
                // Lưu điểm danh cho từng sinh viên
                foreach ($attendance_data as $student_id => $status) {
                    $data = array(
                        'Student_Id' => $student_id,
                        'Object_Id' => $object_id,
                        'Group_Id' => $group_id,
                        'Status' => $status,
                        'Date' => $date
                    );
                    
                    if (!$this->attendanceModel->saveAttendance($data)) {
                        $success = false;
                    }
                }
                
                // Chuyển hướng với thông báo phù hợp
                $message = $success ? 'success' : 'error';
                header("Location: " . Base_URL . "ListClassController/listClass/" . $object_id . "/" . $group_id . "?message=" . $message);
            }
        }
    }
?>