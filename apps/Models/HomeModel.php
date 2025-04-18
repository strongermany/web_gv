<?php
    class HomeModel extends DModel{
        public function __construct(){
            parent::__construct();
            
        }
        
        public function listClass($table){
            $sql = "SELECT Object_Id, Name_class, Group_Id FROM $table";  
            return $this->db->select($sql);
        }
        public function stdBycalss($id_object, $id_group){
            $sql = "SELECT distinct s.* 
                   FROM tbl_student s
                   INNER JOIN tbl_group g ON s.Group_Id = g.Group_Id
                   INNER JOIN tbl_object o ON g.Object_Id = o.Object_Id
                   WHERE o.Object_Id = ? AND s.Group_Id = ?";  
            return $this->db->select($sql, [$id_object, $id_group]);
        }

    }
?>