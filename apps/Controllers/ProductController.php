<?php
class ProductController extends BaseController
{
    public function __construct()
    {

        parent::__construct();
    }
    public function index()
    {
        $this->add_category();
    }
    public function add_category()
    {

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/addCategory');
        $this->load->view('cpanel/footer');
    }
    public function insert_product()
    {

        $category = $_POST['Category'];
        $description = $_POST['Description'];
        $id = $_POST['Id'];

        $table = "tbl_Category";
        $data = array(
            'Category' => $category,
            'Descript_Cate' => $description,
            'Id_Cate' => $id

        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->InsertCategory($table, $data);
        if ($result = 1) {
            $message['msg'] = "Adding category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }
    public function list_category()
    {

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_Category";
        $categoryModel = $this->load->model('CategoryModel');
        $data['category'] = $categoryModel->category($table);

        $this->load->view('cpanel/product/listCategory', $data);
        $this->load->view('cpanel/footer');
    }
    public function delete_category($id){
        $cond = "Id_Cate = '$id'";
        $table = "tbl_Category";
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->DeleteCategory($table,$cond);

        if ($result = 1) {
            $message['msg'] = "Deleting category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }

    public function edit_category($id){
    
    
        $cond = "Id_Cate = $id";
        $table = "tbl_Category";
        $categoryModel = $this->load->model('CategoryModel');
        $data['categoryById'] = $categoryModel->cateByID($table,$cond);

        
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/editCategory',$data);
        $this->load->view('cpanel/footer');
    }

    public function update_category($id){
         
        $cond = "Id_Cate = $id";
        $table = "tbl_Category";
        
        
        $category = $_POST['Category'];
        $description = $_POST['Description'];
        $data = array(
            'Category' => $category,
            'Descript_Cate' => $description
            
        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->UpdateCategory($table,$data,$cond);

        if ($result = 1) {
            $message['msg'] = "Update category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Update category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }

    }
}
