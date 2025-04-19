<?php
class PrivateModel extends DModel {
    public function __construct() {
        parent::__construct();
    }

    public function getAdminInfo($adminId) {
        $sql = "SELECT * FROM tbl_admin WHERE Admin_Id = ?";
        return $this->db->select($sql, [$adminId]);
    }

    public function getTeachingClasses($adminId) {
        // Get all groups and their class names
        $sql = "SELECT g.*, o.Name_class 
                FROM tbl_group g 
                JOIN tbl_object o ON g.Object_Id = o.Object_Id";
        return $this->db->select($sql);
    }

    public function getAttendanceStats($adminId) {
        // Get overall attendance stats
        $sql = "SELECT 
                    COUNT(*) as total_classes,
                    SUM(CASE WHEN Status = 1 THEN 1 ELSE 0 END) as attended_classes,
                    SUM(CASE WHEN Status = 0 THEN 1 ELSE 0 END) as absent_classes
                FROM tbl_attendance";
        return $this->db->select($sql);
    }

    public function updateAdminInfo($adminId, $data) {
        $sql = "UPDATE tbl_admin 
                SET Admin_name = :admin_name,
                    Email = :email,
                    Phone = :phone,
                    Role = :role,
                    Status = :status
                WHERE Admin_Id = :adminId";
        
        $params = array(
            ':admin_name' => $data['admin_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':role' => $data['role'],
            ':status' => $data['status'],
            ':adminId' => $adminId
        );
        
        return $this->db->update($sql, $params, $adminId);
    }

    public function changePassword($adminId, $data) {
        // Kiểm tra mật khẩu hiện tại
        $sql = "SELECT password FROM tbl_admin WHERE Admin_Id = :adminId";
        $params = array(':adminId' => $adminId);
        $result = $this->db->select($sql, $params);
        
        if (!password_verify($data['current_password'], $result[0]['password'])) {
            return false;
        }

        // Cập nhật mật khẩu mới và thời gian đăng nhập
        $sql = "UPDATE tbl_admin 
                SET password = :password,
                    Last_login = CURRENT_TIMESTAMP
                WHERE Admin_Id = :adminId";
        $params = array(
            ':password' => password_hash($data['new_password'], PASSWORD_DEFAULT),
            ':adminId' => $adminId
        );
        
        return $this->db->update($sql, $params, $adminId);
    }

    public function updateLastLogin($adminId) {
        $sql = "UPDATE tbl_admin SET Last_login = CURRENT_TIMESTAMP WHERE Admin_Id = :adminId";
        $params = array(':adminId' => $adminId);
        return $this->db->update($sql, $params, $adminId);
    }
} 