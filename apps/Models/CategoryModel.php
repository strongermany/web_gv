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
    }

?>