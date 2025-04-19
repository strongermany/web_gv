<?php
    class LessionController extends DController {
        protected $model;

        public function __construct() {
            parent::__construct();
            $this->model = $this->load->model('LessionModel');
        }

        public function index() {
            $data['lessions'] = $this->model->getAllLessons('tbl_lession');
            $homemodel = $this->load->model('HomeModel');
            $data['classes'] = $homemodel->listClass('tbl_object');
            $data['list'] = $homemodel->listClass('tbl_object');
            $this->load->view('header',$data);
            $this->load->view('lession/Dashboard', $data);
            $this->load->view('footer');
        }

        public function add() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Xử lý upload file
                $file = $_FILES['lesson_file'];
                $fileName = $file['name'];
                $filePath = '';
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                
                if (!empty($fileName)) {
                    // Tạo tên file mới để tránh trùng lặp
                    $newFileName = uniqid() . '.' . $fileType;
                    $uploadPath = 'public/uploads/';
                    
                    // Tạo thư mục nếu chưa tồn tại
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    
                    // Upload file
                    if (move_uploaded_file($file['tmp_name'], $uploadPath . $newFileName)) {
                        $filePath = $newFileName;
                    }
                }
                
                // Chuẩn bị dữ liệu để lưu vào database
                $data = [
                    'Name_ls' => $_POST['Name_ls'],
                    'Object_Id' => $_POST['Object_Id'],
                    'Name_object' => $_POST['Name_object'],
                    'File_Path' => $filePath,
                    'File_Name' => $fileName,
                    'File_Type' => $fileType,
                    'Description' => $_POST['Description']
                ];
                
                $result = $this->model->addLesson('tbl_lession', $data);
                
                if ($result) {
                    header("Location: " . Base_URL . "LessionController/index");
                } else {
                    echo "Thêm bài giảng thất bại";
                }
            }
        }

       

        public function edit($id) {
            $data['lession'] = $this->model->getLessonById('tbl_lession', $id);
            $homemodel = $this->load->model('HomeModel');
            $data['classes'] = $homemodel->listClass('tbl_object');
            $this->load->view('header');
            $this->load->view('lession/editLession', $data);
            $this->load->view('footer');
        }

        public function update() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['Lession_Id'];
                $data = [
                    'Name_ls' => $_POST['Name_ls'],
                    'Object_Id' => $_POST['Object_Id'],
                    'Name_object' => $_POST['Name_object'],
                    'Description' => $_POST['Description']
                ];
                
                $result = $this->model->updateLesson('tbl_lession', $data, $id);
                
                if ($result) {
                    header("Location: " . Base_URL . "LessionController/index");
                } else {
                    echo "Cập nhật thất bại";
                }
            }
        }

        public function delete($id) {
            $result = $this->model->deleteLesson('tbl_lession', $id);
            
            if ($result) {
                header("Location: " . Base_URL . "LessionController/index");
            } else {
                echo "Xóa thất bại";
            }
        }
    }
?> 