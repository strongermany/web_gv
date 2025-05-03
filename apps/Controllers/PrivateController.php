<?php
class PrivateController extends DController {
    
    protected $db;
    protected $privateModel;
    protected $courseModel;

    public function __construct() {
        parent::__construct();
        Session::init();
        $this->privateModel = $this->load->model('PrivateModel');
        $this->courseModel = $this->load->model('CourseModel');
        $this->db = new Database('mysql:dbname=lecturer; host=127.0.0.1', 'root', '');
    }

    public function index() {
        $adminId = Session::get('Admin_Id');
        if(!$adminId) {
            // Nếu chưa đăng nhập, chỉ hiển thị thông tin cơ bản
            $data = [
                'admin' => null,
                'classes' => [],
                'stats' => (object)['total_classes' => 0, 'attended_classes' => 0, 'absent_classes' => 0],
                'list' => [],
                'categories' => [],
                'sliderItems' => [],
                'newsItems' => [],
                'courses' => []
            ];
        } else {
            // Nếu đã đăng nhập, hiển thị đầy đủ thông tin
            $homeModel = $this->load->model('HomeModel');
            $adminInfo = $this->privateModel->getAdminInfo($adminId);
            $teachingClasses = $this->privateModel->getTeachingClasses($adminId);
            $attendanceStats = $this->privateModel->getAttendanceStats($adminId);
            $classList = $homeModel->listClass('tbl_object');
            $categories = $this->privateModel->getAllCategories();
            $sliderItems = $this->privateModel->getAllSliderItems();
            $newsItems = $this->privateModel->getAllNews();
            $courses = $this->privateModel->getAllCourses();

            $data = [
                'admin' => (object)$adminInfo[0],
                'classes' => $teachingClasses,
                'stats' => (object)($attendanceStats[0] ?? ['total_classes' => 0, 'attended_classes' => 0, 'absent_classes' => 0]),
                'list' => $classList,
                'categories' => $categories,
                'sliderItems' => $sliderItems,
                'newsItems' => $newsItems,
                'courses' => $courses
            ];
        }

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

            if (!in_array($file['type'], $allowedTypes)) {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                exit;
            }

            if ($file['size'] > $maxSize) {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                exit;
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $adminId . '.' . $extension;
            $uploadPath = 'public/images/avatars/' . $newFileName;

            $oldAvatar = $this->privateModel->getAdminInfo($adminId)[0]['avatar'];
            if ($oldAvatar && $oldAvatar !== 'avatar.jpg' && file_exists('public/images/avatars/' . $oldAvatar)) {
                unlink('public/images/avatars/' . $oldAvatar);
            }

            if (!file_exists('public/images/avatars')) {
                mkdir('public/images/avatars', 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
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

    public function toggleNewsStatus($id) {
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        if ($this->privateModel->toggleNewsStatus($id)) {
            header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Cập nhật trạng thái tin tức thành công'));
        } else {
            header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi cập nhật trạng thái tin tức'));
        }
        exit;
    }

    public function deleteNews($id) {
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get news info to delete image
        $news = $this->privateModel->getNewsById($id);
        if ($news && !empty($news[0]['image_url'])) {
            $imagePath = 'public/images/news/' . $news[0]['image_url'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->privateModel->deleteNews($id)) {
            header('Location: ' . Base_URL . 'PrivateController#news?success=' . urlencode('Xóa tin tức thành công'));
        } else {
            header('Location: ' . Base_URL . 'PrivateController#news?error=' . urlencode('Có lỗi xảy ra khi xóa tin tức'));
        }
        exit;
    }

    public function deleteSliderItem($id) {
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get slider info to delete image
        $slider = $this->privateModel->getSliderItemById($id);
        if ($slider && !empty($slider[0]['image_url'])) {
            $imagePath = 'public/images/slider/' . $slider[0]['image_url'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->privateModel->deleteSliderItem($id)) {
            header('Location: ' . Base_URL . 'PrivateController#slider?success=' . urlencode('Xóa slider thành công'));
        } else {
            header('Location: ' . Base_URL . 'PrivateController#slider?error=' . urlencode('Có lỗi xảy ra khi xóa slider'));
        }
        exit;
    }

    public function deleteCourse($id) {
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get course info to delete image
        $course = $this->privateModel->getCourseById($id);
        if ($course && !empty($course['image'])) {
            $imagePath = 'public/images/courses/' . $course['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->privateModel->deleteCourse($id)) {
            header('Location: ' . Base_URL . 'PrivateController#courses?success=' . urlencode('Xóa khóa học thành công'));
        } else {
            header('Location: ' . Base_URL . 'PrivateController#courses?error=' . urlencode('Có lỗi xảy ra khi xóa khóa học'));
        }
        exit;
    }

    protected function checkLogin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: " . Base_URL . "AdminController/login");
            exit();
        }
        return true;
    }

    public function addNews() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'title' => trim($_POST['title']),
                'category' => trim($_POST['category']),
                'content' => trim($_POST['content']),
                'link_url' => isset($_POST['link_url']) ? trim($_POST['link_url']) : '',
                'status' => $_POST['status'],
                'created_by' => $adminId,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Xử lý upload hình ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file = $_FILES['image'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($file['type'], $allowedTypes)) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                    exit;
                }

                if ($file['size'] > $maxSize) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                    exit;
                }

                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = 'news_' . time() . '.' . $extension;
                $uploadPath = 'public/images/news/' . $newFileName;

                if (!file_exists('public/images/news')) {
                    mkdir('public/images/news', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $data['image_url'] = $newFileName;
                }
            }

            if ($this->privateModel->addNews($data)) {
                header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Thêm tin tức thành công'));
            } else {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi thêm tin tức'));
            }
            exit;
        }
    }

    public function addCourse() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'title' => trim($_POST['title']),
                'instructor' => trim($_POST['instructor']),
                'original_price' => floatval($_POST['original_price']),
                'discount' => isset($_POST['discount']) ? floatval($_POST['discount']) : 0,
                'description' => trim($_POST['description']),
                'rating' => isset($_POST['rating']) ? floatval($_POST['rating']) : 0,
                'rating_count' => isset($_POST['rating_count']) ? intval($_POST['rating_count']) : 0,
                'status' => $_POST['status'],
                'created_by' => $adminId,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Tính giá sau giảm giá
            $data['discounted_price'] = $data['original_price'] * (1 - $data['discount'] / 100);

            // Xử lý upload hình ảnh khóa học
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file = $_FILES['image'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($file['type'], $allowedTypes)) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                    exit;
                }

                if ($file['size'] > $maxSize) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                    exit;
                }

                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = 'course_' . time() . '.' . $extension;
                $uploadPath = 'public/images/courses/' . $newFileName;

                if (!file_exists('public/images/courses')) {
                    mkdir('public/images/courses', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $data['image'] = $newFileName;
                }
            }

            if ($this->privateModel->addCourse($data)) {
                header('Location: ' . Base_URL . 'PrivateController?success=' . urlencode('Thêm khóa học thành công'));
            } else {
                header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Có lỗi xảy ra khi thêm khóa học'));
            }
            exit;
        }
    }

    public function addSliderItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adminId = Session::get('Admin_Id');
            if (!$adminId) {
                header('Location: ' . Base_URL . 'index/login');
                exit;
            }

            $data = [
                'category_id' => $_POST['category_id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'link_url' => isset($_POST['link_url']) ? trim($_POST['link_url']) : '',
                'status' => isset($_POST['status']) ? $_POST['status'] : 1,
                'created_by' => $adminId,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Xử lý upload hình ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file = $_FILES['image'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($file['type'], $allowedTypes)) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('Chỉ chấp nhận file ảnh JPG, PNG hoặc GIF'));
                    exit;
                }

                if ($file['size'] > $maxSize) {
                    header('Location: ' . Base_URL . 'PrivateController?error=' . urlencode('File ảnh không được vượt quá 5MB'));
                    exit;
                }

                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName = 'slider_' . time() . '.' . $extension;
                $uploadPath = 'public/images/slider/' . $newFileName;

                if (!file_exists('public/images/slider')) {
                    mkdir('public/images/slider', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $data['image_url'] = $newFileName;
                }
            }

            if ($this->privateModel->addSliderItem($data)) {
                header('Location: ' . Base_URL . 'PrivateController#slider?success=' . urlencode('Thêm slider thành công'));
            } else {
                header('Location: ' . Base_URL . 'PrivateController#slider?error=' . urlencode('Có lỗi xảy ra khi thêm slider'));
            }
            exit;
        }
    }
} 