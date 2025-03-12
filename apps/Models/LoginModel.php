<?php       
    class LoginModel extends BaseModel{
        public function __construct(){
               parent:: __construct();
        }

        public function login($table_admin,$username,$password){
            $sql="Select distinct * from $table_admin WHERE Admin_name = ? AND password = ? ";
            return $this->db->affectedRows($sql,$username,$password);
            
        }
        public function getLogin($table_admin,$username,$password){
            $sql="Select distinct * from $table_admin WHERE Admin_name = ? AND password = ? ";
            return $this->db->selectUser($sql,$username,$password);
            
        }

    }

?>