<?php   
    class CategoryModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function category($sales){
            $sql="Select distinct * from $sales Order by Id_Cate Desc";
            return $this->db->select($sql);
            
        }

        public function cateByID($table,$cond){
            $sql="Select distinct * from $table Where $cond";
            return $this->db->select($sql);
        }

        public function InsertCategory($table,$data){
            return $this->db->insert($table,$data);
        }
        public function UpdateCategory($table,$data,$cond){
            return $this->db->update($table,$data,$cond);

        }
        public function DeleteCategory($table,$cond){
            return $this->db->delete($table,$cond);
        }

        // Post 
        public function InsertCategoryPost($table, $data){
            return $this->db->insert($table,$data);
        }

        public function postCategory($table){
            $sql="Select distinct * from $table Order by Id_category_post Desc";
            return $this->db->select($sql);
            
        }
        public function DeleteCategoryPost($table, $cond)
        {
            return $this->db->delete($table,$cond);
        }
        public function cateByIdPost($table, $cond){
            $sql="Select distinct * from $table Where $cond";
            return $this->db->select($sql);
        }
        public function UpdateCategoryPost($table, $data, $cond){
            return $this->db->update($table,$data,$cond);

        }
        //product
        public function InsertProduct($table, $data){
            return $this->db->insert($table,$data);
        }
        public function product($table_product,$table_category){
            $sql="Select distinct * from $table_product,$table_category 
            where $table_product.Id_category_product =$table_category.Id_Cate 
            Order by Id_product Desc";
            return $this->db->select($sql);
            
        }
        public function DeleteProduct($table,$cond)
        {
            return $this->db->delete($table,$cond);
        }
        public function productByID($table,$cond){
            $sql="Select distinct * from $table Where $cond";
            return $this->db->select($sql);
        }
        public function UpdateProduct($table,$data,$cond){
            return $this->db->update($table,$data,$cond);

        }
        


    }

?>