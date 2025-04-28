<?php
class StudentModel extends DModel {
    public function __construct() {
        parent::__construct();
    }

    public function login($table_student, $username, $password) {
        $sql = "SELECT * FROM $table_student WHERE Student_Id = ? AND Password = ?";
        return $this->db->select($sql, [$username, $password]);
    }

    public function getStudentInfo($studentId) {
        $sql = "SELECT * FROM tbl_student WHERE Student_Id = ?";
        return $this->db->select($sql, [$studentId]);
    }

    public function updateStudentInfo($studentId, $data) {
        $sql = "UPDATE tbl_student 
                SET Student_name = :student_name,
                    Email = :email,
                    Phone = :phone,
                    Status = :status
                WHERE Student_Id = :studentId";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':student_name', $data['student_name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phone', $data['phone']);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':studentId', $studentId);
        
        return $stmt->execute();
    }

    public function changePassword($studentId, $data) {
        // Kiểm tra mật khẩu hiện tại
        $sql = "SELECT Password FROM tbl_student WHERE Student_Id = :studentId";
        $params = array(':studentId' => $studentId);
        $result = $this->db->select($sql, $params);
        
        if ($data['current_password'] !== $result[0]['Password']) {
            return false;
        }

        // Cập nhật mật khẩu mới và thời gian đăng nhập
        $sql = "UPDATE tbl_student 
                SET Password = :password,
                    Last_login = CURRENT_TIMESTAMP
                WHERE Student_Id = :studentId";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', $data['new_password']);
        $stmt->bindValue(':studentId', $studentId);
        
        return $stmt->execute();
    }

    public function updateLastLogin($studentId) {
        $sql = "UPDATE tbl_student SET Last_login = CURRENT_TIMESTAMP WHERE Student_Id = :studentId";
        $params = array(':studentId' => $studentId);
        return $this->db->update($sql, $params, $studentId);
    }

    public function updateAvatar($studentId, $avatarPath) {
        $data = array(
            'Avatar' => $avatarPath,
            'Student_Id' => $studentId
        );
        $cond = "Student_Id = :Student_Id";
        return $this->db->update('tbl_student', $data, $cond);
    }
} 