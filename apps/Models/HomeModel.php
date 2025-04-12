<?php
    class HomeModel extends DModel{
        public function __construct(){
            parent::__construct();
            
        }
        
        public function listClass($table){
            $sql="Select distinct * from $table ";
            $statement = $this->db->prepare($sql);
            // $statement->bindParam(':id',$id);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>