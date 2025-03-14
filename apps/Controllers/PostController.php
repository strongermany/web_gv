<?php
class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->add_category_post();
    }
    public function add_category_post()
    {

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/post/addCategoryPost');
        $this->load->view('cpanel/footer');
    }
    public function insert_category_post()
    {
 
        $title= $_POST['Title'];
        $content= $_POST['Content'];
        
        
        $table = "tbl_category_post";
        $data = array(
            'Title_category_post' => $title,
            'Content_category_post' => $content

        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->InsertCategoryPost($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding category post was successful. ";
            header('Location:' . Base_URL . "PostController/list_category_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding category post was unsuccessful. ";
            header('Location:' . Base_URL . "PostController?msg=" . urldecode(serialize($message)));
        }
    }
    public function list_category_post()
    {   

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $data['category'] = $categoryModel->postCategory($table);

        $this->load->view('cpanel/post/listCategoryPost', $data);
        $this->load->view('cpanel/footer');
    }
    public function delete_category_post($id)
    {
        $cond = "Id_category_post = '$id'";
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->DeleteCategoryPost($table, $cond);

        if ($result ==1) {
            $message['msg'] = "Deleting category post was successful. ";
            header('Location:' . Base_URL . "PostController/list_category_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting post category was unsuccessful. ";
            header('Location:' . Base_URL . "PostController?msg=" . urldecode(serialize($message)));
        }
    }

    public function edit_category_post($id)
    {
       
        $cond = "Id_category_post = $id";
        $table = "tbl_category_post";
        $categoryModel = $this->load->model('CategoryModel');
        $data['categoryById'] = $categoryModel->cateByIdPost($table, $cond);
        
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/post/editCategoryPost', $data);
        $this->load->view('cpanel/footer');
    }

    public function update_category_post($id)
    {

        $cond = "Id_category_post = $id";
        $table = "tbl_category_post";

        echo"1";
        $title = $_POST['Title'];
        $content = $_POST['Content'];
        $data = array(
            'Title_category_post' => $title,
            'Content_category_post' => $content

        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->UpdateCategoryPost($table, $data, $cond);
        echo"1";
        if ($result == 1) {
            $message['msg'] = "Update category post was successful. ";
            header('Location:' . Base_URL . "PostController/list_category_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Update category post was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }
}
