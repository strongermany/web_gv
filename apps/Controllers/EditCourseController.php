<?php
class EditCourseController extends DController {
    
    protected $privateModel;
    protected $courseModel;

    public function __construct() {
        parent::__construct();
        Session::init();
        // Check if user is logged in
        if (!Session::get('login')) {
            header("Location:" . Base_URL . "index/login");
            exit();
        }
        $this->privateModel = $this->load->model('PrivateModel');
        $this->courseModel = $this->load->model('CourseModel');
    }

    // Hiển thị form chỉnh sửa khóa học
    public function index($id) {
        $this->checkLogin();
        
        // Lấy thông tin khóa học
        $course = $this->privateModel->getCourseById($id);
        
        if (!$course) {
            header("Location: " . Base_URL . "PrivateController/coursesManager?error=notfound");
            exit;
        }

        // Get admin info from session
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get admin details
        $adminInfo = $this->privateModel->getAdminInfo($adminId);
        if (empty($adminInfo)) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get necessary data for header
        $homemodel = $this->load->model('HomeModel');
        $data = [
            'admin' => (object)$adminInfo[0],
            'list' => $homemodel->listClass('tbl_object'),
            'page' => 'courses',
            'title' => 'Chỉnh sửa khóa học',
            'course' => $course,
            'courses' => $this->privateModel->getAllCourses()
        ];

        $this->load->view('header', $data);
        $this->load->view('private/editCourse', $data);
        $this->load->view('footer');
    }

    // Xử lý cập nhật khóa học
    public function update($id) {
        $this->checkLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin khóa học hiện tại
            $course = $this->privateModel->getCourseById($id);
            
            if (!$course) {
                $_SESSION['error'] = "Không tìm thấy khóa học với ID: " . $id;
                header("Location: " . Base_URL . "PrivateController");
                exit;
            }

            // Chuẩn bị dữ liệu cập nhật
            $data = [
                'title' => $_POST['title'],
                'instructor' => $_POST['instructor'],
                'description' => $_POST['description'],
                'original_price' => $_POST['original_price'],
                'discount' => $_POST['discount'] ?? 0,
                'rating' => $_POST['rating'] ?? 0,
                'rating_count' => $_POST['rating_count'] ?? 0,
                'image' => $course['image'] // Giữ ảnh cũ nếu không có ảnh mới
            ];

            // Xử lý upload ảnh mới nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image'], 'courses');
                if ($image) {
                    // Xóa ảnh cũ nếu có
                    if ($course['image'] && file_exists("public/images/courses/" . $course['image'])) {
                        unlink("public/images/courses/" . $course['image']);
                    }
                    $data['image'] = $image;
                }
            }

            // Tính giá sau khi giảm
            $data['discounted_price'] = $data['original_price'] * (1 - ($data['discount'] / 100));

            // Cập nhật khóa học
            if ($this->privateModel->updateCourse($id, $data)) {
                $_SESSION['success'] = "Cập nhật khóa học thành công";
                header("Location: " . Base_URL . "PrivateController");
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật khóa học";
                header("Location: " . Base_URL . "EditCourseController/index/" . $id);
            }
            exit;
        }

        // Nếu không phải POST request, chuyển hướng về trang profile
        header("Location: " . Base_URL . "PrivateController");
        exit;
    }

    // Hàm hỗ trợ upload ảnh
    private function uploadImage($file, $folder) {
        $target_dir = "public/images/" . $folder . "/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (!in_array($file_extension, $allowed_types)) {
            return false;
        }

        $new_filename = uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $new_filename;
        }

        return false;
    }

    protected function checkLogin() {
        if (!Session::get('login')) {
            header("Location:" . Base_URL . "index/login");
            exit();
        }
        return true;
    }
} 