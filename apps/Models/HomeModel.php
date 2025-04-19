<?php
    class HomeModel extends DModel{
        public function __construct(){
            parent::__construct();
            
        }
        
        public function listClass($table){
            try {
                $sql = "SELECT DISTINCT o.Object_Id, o.Name_class, g.Group_Id 
                        FROM $table o
                        LEFT JOIN tbl_group g ON o.Object_Id = g.Object_Id
                        WHERE o.Object_Id IS NOT NULL
                        ORDER BY o.Name_class, g.Group_Id";
                return $this->db->select($sql);
            } catch (Exception $e) {
                // Log error if needed
                return false;
            }
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