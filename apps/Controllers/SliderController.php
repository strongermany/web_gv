<?php
class SliderController extends DController {
    private $sliderModel;

    public function __construct() {
        parent::__construct();
        $this->sliderModel = new PrivateModel();
    }

    public function index() {
        $data = [
            'categories' => $this->sliderModel->getAllCategories(),
            'sliderItems' => $this->sliderModel->getAllSliderItems()
        ];
        $this->load->view('private/slider_management', $data);
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'category_name' => $_POST['category_name'],
                'category_code' => $_POST['category_code']
            ];
            
            if ($this->sliderModel->addCategory($data)) {
                $_SESSION['success'] = 'Thêm danh mục thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm danh mục';
            }
            header('Location: ' . Base_URL . 'SliderController');
        }
    }

    public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'category_id' => $_POST['category_id'],
                'category_name' => $_POST['category_name'],
                'category_code' => $_POST['category_code']
            ];
            
            if ($this->sliderModel->updateCategory($data)) {
                $_SESSION['success'] = 'Cập nhật danh mục thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật danh mục';
            }
            header('Location: ' . Base_URL . 'SliderController');
        }
    }

    public function deleteCategory($id) {
        if ($this->sliderModel->deleteCategory($id)) {
            $_SESSION['success'] = 'Xóa danh mục thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa danh mục';
        }
        header('Location: ' . Base_URL . 'SliderController');
    }

    public function addSliderItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle file upload
            $image_url = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/images/slider/";
                $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $newFileName;
                }
            }

            $data = [
                'category_id' => $_POST['category_id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image_url' => $image_url,
                'link_url' => $_POST['link_url']
            ];
            
            if ($this->sliderModel->addSliderItem($data)) {
                $_SESSION['success'] = 'Thêm slide thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm slide';
            }
            header('Location: ' . Base_URL . 'SliderController');
        }
    }

    public function updateSliderItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'item_id' => $_POST['item_id'],
                'category_id' => $_POST['category_id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'link_url' => $_POST['link_url']
            ];

            // Handle file upload if new image is provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/images/slider/";
                $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $newFileName;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $data['image_url'] = $newFileName;
                }
            } else {
                $data['image_url'] = $_POST['current_image'];
            }
            
            if ($this->sliderModel->updateSliderItem($data)) {
                $_SESSION['success'] = 'Cập nhật slide thành công';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật slide';
            }
            header('Location: ' . Base_URL . 'SliderController');
        }
    }

    public function deleteSliderItem($id) {
        if ($this->sliderModel->deleteSliderItem($id)) {
            $_SESSION['success'] = 'Xóa slide thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa slide';
        }
        header('Location: ' . Base_URL . 'SliderController');
    }
} 