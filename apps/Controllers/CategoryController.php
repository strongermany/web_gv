<?php
    class CategoryController extends BaseController{
        
        public function __construct(){
            $message = array();
            parent:: __construct();
            
        }

        public function showCate() {
            $CategoryModel = $this->load->model('CategoryModel'); 
            $sales = 'sales';
            $data['Category'] = $CategoryModel->category($sales); // Gán dữ liệu vào biến 'category'$da
            
            $this->load->view('HomeView', $data); // Truyền $data vào view
        }

        public function categoryById(){
            $CategoryModel = $this->load->model('CategoryModel'); 
            $id = 2;
            $sales = 'sales';
            $data['CategoryById'] = $CategoryModel->cateById($sales,$id); // Gán dữ liệu vào biến 'category'$da
            
            $this->load->view('categoryById', $data); // Truyền $data vào view
                    
        }

        public function addCategory(){
            $this->load->view('addCategory');
        }

        public function InsertCategory(){
            $CategoryModel = $this->load->model('CategoryModel'); 
            $table = 'sales';
            $title = $_POST['title'];// Having the same name in form
            $description = $_POST['description'];
            
            $data = array(
                'Category'=>$title,
                'Descript_Cate'=>$description
            );
            
            $result= $CategoryModel->InsertCategory($table,$data);//return 0 or 1.
            if($result == 1 ){
                $message['msg'] = 'Add data was successful';
            }
            else{
                $message['msg'] = 'Add data was unsuccessful';
                
            }
            $this->load->view('addCategory',$message);
            
            
        }
    }

?>