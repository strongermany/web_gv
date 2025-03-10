<?php   
    class CategoryModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function category($sales){
            $sql="Select distinct * from $sales ";
            return $this->db->select($sql);
            
        }

        public function cateByID($table,$id){
            $sql="Select distinct * from $table where Id_Cate=:id";
            $statement = $this->db->prepare($sql);
            $data =array(':id' =>$id);
            return $this->db->select($sql,$data);
        }

        public function InsertCategory($table,$data){
            return $this->db->insert($table,$data);
         
     
     

        }
    }

?>