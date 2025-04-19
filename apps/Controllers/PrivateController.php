<?php
class PrivateController extends DController {
    

    public function __construct() {
        parent::__construct();
        Session::init();
        // Check if user is logged in
        if (!Session::get('login')) {
            header("Location:" . Base_URL . "index/login");
            exit();
        }
        $this->privateModel = $this->load->model('PrivateModel');
    }

    public function index() {
        // Get admin info from session
        $adminId = Session::get('Admin_Id');
        
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get admin details
        $adminInfo = $this->privateModel->getAdminInfo($adminId);
        
        // Debug output
        error_log("Admin Info: " . print_r($adminInfo, true));
        
        if (empty($adminInfo)) {
            error_log("No admin info found for ID: " . $adminId);
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get teaching classes
        $teachingClasses = $this->privateModel->getTeachingClasses($adminId);
        
        // Get attendance stats
        $attendanceStats = $this->privateModel->getAttendanceStats($adminId);

        // Get class list for header menu
        $homemodel = $this->load->model('HomeModel');
        $classList = $homemodel->listClass('tbl_object');

        $data = [
            'admin' => (object)$adminInfo[0], // Convert array to object
            'classes' => $teachingClasses,
            'stats' => (object)($attendanceStats[0] ?? ['total_classes' => 0, 'attended_classes' => 0, 'absent_classes' => 0]),
            'list' => $classList // Add class list for header menu
        ];

        // Debug output
        //error_log("Profile Data: " . print_r($data, true));

        $this->load->view('header', $data);
        $this->load->view('private/profile', $data);
        $this->load->view('footer');
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'admin_name' => trim($_POST['admin_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'role' => trim($_POST['role']),
                'status' => trim($_POST['status'])
            ];

            if ($this->privateModel->updateAdminInfo($adminId, $data)) {
                header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Cập nhật thông tin thành công'));
            } else {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi cập nhật thông tin'));
            }
            exit;
        }
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'current_password' => $_POST['current_password'],
                'new_password' => $_POST['new_password'],
                'confirm_password' => $_POST['confirm_password']
            ];

            if ($data['new_password'] !== $data['confirm_password']) {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Mật khẩu mới không khớp'));
                exit;
            }

            if ($this->privateModel->changePassword($adminId, $data)) {
                header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Đổi mật khẩu thành công'));
            } else {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Mật khẩu hiện tại không đúng'));
            }
            exit;
        }
    }

    public function updateAvatar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            // Kiểm tra loại file
            if (!in_array($file['type'], $allowedTypes)) {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                exit;
            }

            // Kiểm tra kích thước file
            if ($file['size'] > $maxSize) {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                exit;
            }

            // Tạo tên file mới - đơn giản hóa tên file
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $adminId . '.' . $extension;  // Ví dụ: ad01.jpg
            $uploadPath = 'public/images/avatars/' . $newFileName;

            // Xóa file avatar cũ nếu tồn tại và khác avatar mặc định
            $oldAvatar = $this->privateModel->getAdminInfo($adminId)[0]['avatar'];
            if ($oldAvatar && $oldAvatar !== 'avatar.jpg' && file_exists('public/images/avatars/' . $oldAvatar)) {
                unlink('public/images/avatars/' . $oldAvatar);
            }

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists('public/images/avatars')) {
                mkdir('public/images/avatars', 0777, true);
            }

            // Upload file
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Cập nhật đường dẫn avatar trong database
                if ($this->privateModel->updateAvatar($adminId, $newFileName)) {
                    header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Cập nhật avatar thành công'));
                } else {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi cập nhật avatar'));
                }
            } else {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi upload file'));
            }
            exit;
        }
    }
} 