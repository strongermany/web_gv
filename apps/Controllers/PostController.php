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
    public function add_post(){
        
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_category_post";
        $postModel = $this->load->model('PostModel');
        $data['category'] = $postModel->category_post($table);


        $this->load->view('cpanel/post/addPost',$data);
        $this->load->view('cpanel/footer');

    }
    public function insert_post(){
        $title = $_POST['title_post'];
     
        $content = $_POST['content_post'];
        $image = $_FILES['image_post']['name'];
        $tmp_img = $_FILES['image_post']['tmp_name'];

        $div = explode('.',$image);
        $file_ext=strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads= "public/uploads/post/".$unique_image;
        if (move_uploaded_file($tmp_img, $path_uploads)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
        }

      
        $category = $_POST['category_post'];
        $table = "tbl_post";
        $data = array(
            'Title_post' => $title,
            'Content_post' => $content,
            'Image_post' => $unique_image,
            'Id_category_post' => $category
            
        );
        $postModel = $this->load->model('PostModel');
        $result = $postModel->InsertPost($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding Blog was successful. ";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding Blog was unsuccessful. ";
            header('Location:' . Base_URL . "PostController/add_post?msg=" . urldecode(serialize($message)));
        }
    }
    public function list_post()
    {

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table_post = "tbl_post";
        $table_category = "tbl_category_post";

        $postModel = $this->load->model('PostModel');
        $data['post'] = $postModel->post($table_post,$table_category);

        $this->load->view('cpanel/post/listPost', $data);
        $this->load->view('cpanel/footer');
    }
    public function delete_post($id){
        
        $table_post = "tbl_post";
        $cond="Id_post = '$id'";
        $postModel = $this->load->model('PostModel');
        $result = $postModel->DeletePost($table_post,$cond);

        if ($result == 1) {
            $message['msg'] = "Deleting blog was successful. ";
            header('Location:' . Base_URL . "PostController/list_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Deleting blog was unsuccessful. ";
            header('Location:' . Base_URL . "PostController/list_post?msg=" . urldecode(serialize($message)));
        }

    }
    public function edit_post($id){
          
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $cond="Id_post = '$id'";
        $table = "tbl_category_post";
        $table_post ="tbl_post";
        $postModel = $this->load->model('PostModel');
        $data['category'] = $postModel->category_post($table);
        $data['postById'] = $postModel->postById($table_post,$cond);



        $this->load->view('cpanel/post/editPost',$data);
        $this->load->view('cpanel/footer');
    }
    public function update_post($id){
        
        $category = $_POST['category_post'];
        $table_post = "tbl_post";
        $postModel = $this->load->model('PostModel');
        $cond="Id_post = $id";

        $title = $_POST['title_post'];
        $content = $_POST['content_post'];
        $image = $_FILES['image_post']['name'];
        $tmp_img = $_FILES['image_post']['tmp_name'];

        $div = explode('.',$image);
        $file_ext=strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads= "public/uploads/post/".$unique_image;

        if($image){
            $data['postById'] = $postModel->postById($table_post,$cond);

            foreach($data['postById'] as $key => $value){
                $path_unlink="public/uploads/post/";
                unlink($path_unlink.$value['Image_post']);
            }
            $data = array(
                'Title_post' => $title,
                'Content_post' => $content,
                'Image_post' => $unique_image,
                'Id_category_post' => $category
            
        );
        move_uploaded_file($tmp_img, $path_uploads);
        }
        else{
                
            $data = array(
                'Title_post' => $title,
                'Content_post' => $content,
                //'Image_post' => $unique_image,
                'Id_category_post' => $category
                
        );
        }
        // if (move_uploaded_file($tmp_img, $path_uploads)) {
        //     echo "File uploaded successfully!";
        // } else {
        //     echo "File upload failed!";
        // }

      
        
        $result = $postModel->UpdatePost($table_post,$data,$cond);
        if ($result == 1) {
            $message['msg'] = "Update Blog was successful. ";
            header('Location:' . Base_URL . "PostController/list_post?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "update Blog was unsuccessful. ";
            header('Location:' . Base_URL . "PostController/list_post?msg=" . urldecode(serialize($message)));
        }
    }

}
