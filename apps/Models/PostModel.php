<?php   
    class PostModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function category_post($sales){
            $sql="Select distinct * from $sales Order by Id_category_post Desc";
            return $this->db->select($sql);
            
        }

        public function cateByID($table,$cond){
            $sql="Select distinct * from $table Where $cond";
            return $this->db->select($sql);
        }

        public function InsertPost($table,$data){
            return $this->db->insert($table,$data);
        }
        public function UpdateCategory($table,$data,$cond){
            return $this->db->update($table,$data,$cond);

        }
        public function DeletePost($table_post,$cond){
            return $this->db->delete($table_post,$cond);
        }
        public function post($table_post,$table_category_post){
            $sql="Select distinct * from $table_post,$table_category_post
            where $table_post.Id_category_post =$table_category_post.Id_category_post
            Order by $table_category_post.Id_category_post Desc";
            return $this->db->select($sql);
            
        }
        public function postById($table_post,$cond){
            $sql="Select distinct * from $table_post Where $cond";
            return $this->db->select($sql);
        }
        public function UpdatePost($table_post, $data,$cond){
            return $this->db->update($table_post, $data,$cond);
        }
     

    }

?>