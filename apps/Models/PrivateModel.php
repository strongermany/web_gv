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
        // Get all groups and their class names with student count
        $sql = "SELECT g.*, o.Name_class, o.Object_Id as Class_Id,
                (SELECT COUNT(*) FROM tbl_student s WHERE s.Group_Id = g.Group_Id) as total_students
                FROM tbl_group g 
                JOIN tbl_object o ON g.Object_Id = o.Object_Id";
        return $this->db->select($sql);
    }

    public function getAttendanceStats($adminId) {
        // Get overall attendance stats
        $sql = "SELECT 
                (SELECT COUNT(*) FROM tbl_group) as total_classes,
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
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':admin_name', $data['admin_name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phone', $data['phone']);
        $stmt->bindValue(':role', $data['role']);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':adminId', $adminId);
        
        return $stmt->execute();
    }

    public function changePassword($adminId, $data) {
        // Kiểm tra mật khẩu hiện tại
        $sql = "SELECT password FROM tbl_admin WHERE Admin_Id = :adminId";
        $params = array(':adminId' => $adminId);
        $result = $this->db->select($sql, $params);
        
        if ($data['current_password'] !== $result[0]['password']) {
            return false;
        }

        // Cập nhật mật khẩu mới và thời gian đăng nhập
        $sql = "UPDATE tbl_admin 
                SET password = :password,
                    Last_login = CURRENT_TIMESTAMP
                WHERE Admin_Id = :adminId";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', $data['new_password']);
        $stmt->bindValue(':adminId', $adminId);
        
        return $stmt->execute();
    }

    public function updateLastLogin($adminId) {
        $sql = "UPDATE tbl_admin SET Last_login = CURRENT_TIMESTAMP WHERE Admin_Id = :adminId";
        $params = array(':adminId' => $adminId);
        return $this->db->update($sql, $params, $adminId);
    }

    public function updateAvatar($adminId, $avatarPath) {
        $data = array(
            'avatar' => $avatarPath,
            'Admin_Id' => $adminId
        );
        $cond = "Admin_Id = :Admin_Id";
        return $this->db->update('tbl_admin', $data, $cond);
    }

    public function getAdminInfoForHeader($adminId) {
        $sql = "SELECT Admin_Id, Admin_name, avatar FROM tbl_admin WHERE Admin_Id = ?";
        $result = $this->db->select($sql, [$adminId]);
        return !empty($result) ? $result[0] : null;
    }
} 