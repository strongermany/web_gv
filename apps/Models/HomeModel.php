<?php
    class HomeModel extends DModel{
        public function __construct(){
            parent::__construct();
            
        }
        
        public function listClass($table){
            $sql="Select distinct * from $table ";  
            return $this->db->select($sql);
        }
        public function stdBycalss($id){
            $sql="Select distinct Name_std from tbl_list_std,tbl_class_object 
            Where tbl_list_std.Id_class =tbl_class_object.Id_class 
            and tbl_class_object.Id_class = '$id'";  
            return $this->db->select($sql);
        }
    }
?>