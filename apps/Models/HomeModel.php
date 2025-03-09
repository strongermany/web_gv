<?php   
    class HomeModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function category(){
            $sql="Select  distinct * from sales order by Id_Cate desc";
            $query = $this->db->query($sql);
            $result = $query->fetchAll();
            
            
            
            return $result;
        }
    }

?>