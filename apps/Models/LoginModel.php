<?php       
    class LoginModel extends DModel{
        public function __construct(){
               parent:: __construct();
               // Set timezone for Vietnam
               date_default_timezone_set('Asia/Ho_Chi_Minh');
        }

        public function login($table_admin,$username,$password){
            $sql="Select distinct * from $table_admin WHERE Admin_name = ? AND password = ? ";
            return $this->db->affectedRows($sql,$username,$password);
            
        }
        public function getLogin($table_admin,$username,$password){
            $sql="Select distinct * from $table_admin WHERE Admin_name = ? AND password = ? ";
            $result = $this->db->selectUser($sql,$username,$password);
            
            // Nếu đăng nhập thành công, cập nhật Last_login
            if (!empty($result)) {
                $this->updateLastLogin($result[0]['Admin_Id']);
            }
            
            return $result;
        }

        public function updateLastLogin($adminId) {
            $data = array(
                'Last_login' => date('Y-m-d H:i:s'), // This will now use Vietnam timezone
                'Admin_Id' => $adminId
            );
            $cond = "Admin_Id = :Admin_Id";
            return $this->db->update('tbl_admin', $data, $cond);
        }
    }

?>