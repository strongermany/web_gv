<?php
class StudentController extends DController {
    public function __construct() {
        parent::__construct();
        Session::init();
    }

    public function index() {
        $studentId = Session::get('Student_Id');
        if(!$studentId) {
            $data = [
                'student' => null,
                'classes' => [],
                'stats' => (object)['total_classes' => 0, 'attended_classes' => 0, 'absent_classes' => 0]
            ];
        } else {
            $studentModel = $this->load->model('StudentModel');
            $studentInfo = $studentModel->getStudentInfo($studentId);
            
            $data = [
                'student' => (object)$studentInfo[0],
                'classes' => [],
                'stats' => (object)['total_classes' => 0, 'attended_classes' => 0, 'absent_classes' => 0]
            ];
        }

        $this->load->view('header', $data);
        $this->load->view('student/profile', $data);
        $this->load->view('footer');
    }

    public function authentication_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            
            $table_student = 'tbl_student';
            $studentModel = $this->load->model('StudentModel');
            $count = $studentModel->login($table_student, $username, $password);
            
            if($count == 0) {
                $message['msg'] = 'Mã sinh viên hoặc mật khẩu không đúng';
                header("Location:".Base_URL."index/login");
            } else {
                $result = $studentModel->getStudentInfo($username);
                Session::set('login', true);
                Session::set('Student_Id', $result[0]['Student_Id']);
                Session::set('Student_name', $result[0]['Student_name']);
                header("Location:".Base_URL."StudentController");
            }
        }
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = Session::get('Student_Id');
            if (!$studentId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'student_name' => trim($_POST['student_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'status' => trim($_POST['status'])
            ];

            $studentModel = $this->load->model('StudentModel');
            if ($studentModel->updateStudentInfo($studentId, $data)) {
                header('Location: ' . Base_URL . 'StudentController?success=' . urlencode('Cập nhật thông tin thành công'));
            } else {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Có lỗi xảy ra khi cập nhật thông tin'));
            }
            exit;
        }
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = Session::get('Student_Id');
            if (!$studentId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'current_password' => $_POST['current_password'],
                'new_password' => $_POST['new_password'],
                'confirm_password' => $_POST['confirm_password']
            ];

            if ($data['new_password'] !== $data['confirm_password']) {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Mật khẩu mới không khớp'));
                exit;
            }

            $studentModel = $this->load->model('StudentModel');
            if ($studentModel->changePassword($studentId, $data)) {
                header('Location: ' . Base_URL . 'StudentController?success=' . urlencode('Đổi mật khẩu thành công'));
            } else {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Mật khẩu hiện tại không đúng'));
            }
            exit;
        }
    }

    public function updateAvatar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
            $studentId = Session::get('Student_Id');
            if (!$studentId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            if (!in_array($file['type'], $allowedTypes)) {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                exit;
            }

            if ($file['size'] > $maxSize) {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                exit;
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $studentId . '.' . $extension;
            $uploadPath = 'public/images/avatars/' . $newFileName;

            $studentModel = $this->load->model('StudentModel');
            $oldAvatar = $studentModel->getStudentInfo($studentId)[0]['Avatar'];
            if ($oldAvatar && $oldAvatar !== 'avatar.jpg' && file_exists('public/images/avatars/' . $oldAvatar)) {
                unlink('public/images/avatars/' . $oldAvatar);
            }

            if (!file_exists('public/images/avatars')) {
                mkdir('public/images/avatars', 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                if ($studentModel->updateAvatar($studentId, $newFileName)) {
                    header('Location: ' . Base_URL . 'StudentController?success=' . urlencode('Cập nhật avatar thành công'));
                } else {
                    header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Có lỗi xảy ra khi cập nhật avatar'));
                }
            } else {
                header('Location: ' . Base_URL . 'StudentController?error=' . urlencode('Có lỗi xảy ra khi upload file'));
            }
            exit;
        }
    }

    public function logout() {
        Session::init();
        Session::destroy();
        header("Location:".Base_URL."index");
    }
} 