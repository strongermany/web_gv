<?php
class EditNewsController extends DController {
    
    protected $privateModel;

    public function __construct() {
        parent::__construct();
        Session::init();
        $this->privateModel = $this->load->model('PrivateModel');
    }

    public function index($id) {
        $this->checkLogin();
        
        // Lấy thông tin tin tức
        $news = $this->privateModel->getNewsById($id);
        
        if (!$news) {
            $_SESSION['error'] = "Không tìm thấy tin tức với ID: " . $id;
            header("Location: " . Base_URL . "PrivateController");
            exit;
        }

        // Lấy danh sách danh mục
        $categories = $this->privateModel->getAllCategories();

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
            'page' => 'news',
            'title' => 'Chỉnh sửa tin tức',
            'news' => $news[0],
            'categories' => $categories
        ];

        $this->load->view('header', $data);
        $this->load->view('private/edit_news', $data);
        $this->load->view('footer');
    }

    public function update($id) {
        $this->checkLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin tin tức hiện tại
            $news = $this->privateModel->getNewsById($id);
            
            if (!$news) {
                $_SESSION['error'] = "Không tìm thấy tin tức với ID: " . $id;
                header("Location: " . Base_URL . "PrivateController");
                exit;
            }

            // Chuẩn bị dữ liệu cập nhật
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'category' => $_POST['category'],
                'link_url' => $_POST['link_url'],
                'image_url' => $news[0]['image_url'] // Giữ ảnh cũ nếu không có ảnh mới
            ];

            // Xử lý upload ảnh mới nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image'], 'news');
                if ($image) {
                    // Xóa ảnh cũ nếu có
                    if ($news[0]['image_url'] && file_exists("public/images/news/" . $news[0]['image_url'])) {
                        unlink("public/images/news/" . $news[0]['image_url']);
                    }
                    $data['image_url'] = $image;
                }
            }

            // Cập nhật tin tức
            if ($this->privateModel->updateNews($id, $data)) {
                $_SESSION['success'] = "Cập nhật tin tức thành công";
                header("Location: " . Base_URL . "PrivateController");
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật tin tức";
                header("Location: " . Base_URL . "EditNewsController/index/" . $id);
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
