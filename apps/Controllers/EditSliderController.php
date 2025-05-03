<?php
class editSliderController extends DController {
    protected $sliderModel;

    public function __construct() {
        parent::__construct();
        Session::init();
        $this->sliderModel = $this->load->model('PrivateModel');
    }

    // Hiển thị form chỉnh sửa slider
    public function index($id) {
        $this->checkLogin();
        $slider = $this->sliderModel->getSliderItemById($id);
        if (!$slider || empty($slider[0])) {
            $_SESSION['error'] = 'Không tìm thấy slider với ID: ' . $id;
            header('Location: ' . Base_URL . 'SliderController');
            exit;
        }

        // Get admin info from session
        $adminId = Session::get('Admin_Id');
        if (!$adminId) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get admin details
        $adminInfo = $this->sliderModel->getAdminInfo($adminId);
        if (empty($adminInfo)) {
            header('Location: ' . Base_URL . 'index/login');
            exit;
        }

        // Get necessary data for header
        $homemodel = $this->load->model('HomeModel');
        $categories = $this->sliderModel->getAllCategories();
        
        $data = [
            'admin' => (object)$adminInfo[0],
            'list' => $homemodel->listClass('tbl_object'),
            'page' => 'slider',
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider[0],
            'categories' => $categories
        ];

        $this->load->view('header', $data);
        $this->load->view('private/edit_slider', $data);
        $this->load->view('footer');
    }

    // Xử lý cập nhật slider
    public function update($id) {
        $this->checkLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slider = $this->sliderModel->getSliderItemById($id);
            if (!$slider || empty($slider[0])) {
                $_SESSION['error'] = 'Không tìm thấy slider với ID: ' . $id;
                header('Location: ' . Base_URL . 'SliderController');
                exit;
            }
            $slider = $slider[0];
            $data = [
                'item_id' => $id,
                'category_id' => $_POST['category_id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'link_url' => $_POST['link_url'],
                'image_url' => $slider['image_url'], // giữ ảnh cũ nếu không có ảnh mới
                'status' => $slider['status'] // giữ trạng thái cũ
            ];

            // Xử lý upload ảnh mới nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image'], 'slider');
                if ($image) {
                    // Xóa ảnh cũ nếu có
                    if ($slider['image_url'] && file_exists("public/images/slider/" . $slider['image_url'])) {
                        unlink("public/images/slider/" . $slider['image_url']);
                    }
                    $data['image_url'] = $image;
                }
            }

            if ($this->sliderModel->updateSliderItem($data)) {
                $_SESSION['success'] = 'Cập nhật slider thành công';
                header('Location: ' . Base_URL . 'PrivateController');
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật slider';
                header('Location: ' . Base_URL . 'EditSliderController/index/' . $id);
            }
            exit;
        }
        header('Location: ' . Base_URL . 'SliderController');
        exit;
    }

    // Hàm hỗ trợ upload ảnh
    private function uploadImage($file, $folder) {
        $target_dir = "public/images/" . $folder . "/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif", "webp");
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
