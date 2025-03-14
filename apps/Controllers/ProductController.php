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
    public function add_product()
    {

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_category";
        $categoryModel = $this->load->model('CategoryModel');
        $data['category'] = $categoryModel->category($table);


        $this->load->view('cpanel/product/addProduct',$data);
        $this->load->view('cpanel/footer');
    }
    public function insert_category()
    {

        $category = $_POST['Category'];
        $description = $_POST['Description'];
     
        $table = "tbl_Category";
        $data = array(
            'Category' => $category,
            'Descript_Cate' => $description
            
        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->InsertCategory($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }
    }

    public function insert_product()
    {

        $title = $_POST['title_product'];

        $image = $_FILES['image']['name'];
        $tmp_img = $_FILES['image']['tmp_name'];

        $div = explode('.',$image);
        $file_ext=strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads= "public/uploads/product/".$unique_image;
        if (move_uploaded_file($tmp_img, $path_uploads)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
        }

        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['desc_product'];
        $product_category = $_POST['product_category'];
     
        $table = "tbl_product";
        $data = array(
            'Title_product' => $title,
            'Price_product' => $price,
            'Desc_product' => $description,
            'Quantity_product' => $quantity,
            'Images_product' => $unique_image,
            'Id_category_product' => $product_category
            
        );
        $categoryModel = $this->load->model('CategoryModel');
        $result = $categoryModel->InsertProduct($table, $data);
        if ($result == 1) {
            $message['msg'] = "Adding category was successful. ";
            //header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Adding category was unsuccessful. ";
            //header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
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

        if ($result == 1) {
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

        if ($result == 1) {
            $message['msg'] = "Update category was successful. ";
            header('Location:' . Base_URL . "ProductController/list_category?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = "Update category was unsuccessful. ";
            header('Location:' . Base_URL . "ProductController?msg=" . urldecode(serialize($message)));
        }

    }
}
