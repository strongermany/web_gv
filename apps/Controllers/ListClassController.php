<?php
    class ListClassController extends DController{
        public function __construct(){
            parent::__construct();
        }
      
        public function listClass($id_object,$id_group){
            // Load cả hai model
            $homemodel = $this->load->model('HomeModel');
            
            $attendanceModel = $this->load->model('AttendanceModel');
            
            // Lấy danh sách lớp cho menu
            $data['list'] = $homemodel->listClass('tbl_object');
            
            // Lấy danh sách sinh viên của lớp
            $data['std'] = $attendanceModel->getStudentsByClass($id_object, $id_group);
            
            // Lấy dữ liệu điểm danh của ngày hiện tại nếu có
            $today = date('Y-m-d');
            $data['attendance'] = $attendanceModel->getAttendanceByDate($id_object, $id_group, $today);
            
            // Lưu ID môn học và lớp để form điểm danh sử dụng
            $data['object_id'] = $id_object;
            $data['group_id'] = $id_group;
            
            $this->load->view('header', $data);
            $this->load->view('listClass',$data);
            $this->load->view('footer');
        }

        public function saveAttendance(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $attendanceModel = $this->load->model('AttendanceModel');
                
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
                    
                    if (!$attendanceModel->saveAttendance($data)) {
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