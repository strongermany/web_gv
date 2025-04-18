<?php
class AttendanceModel extends DModel {
    public function __construct() {
        parent::__construct();
    }

    // Lấy danh sách sinh viên theo lớp và môn học
    public function getStudentsByClass($object_id, $group_id) {
        $sql = "SELECT s.Student_Id, s.Name_std, s.Email_std, s.Group_Id 
                FROM tbl_student s
                INNER JOIN tbl_group g ON s.Group_Id = g.Group_Id
                INNER JOIN tbl_object o ON g.Object_Id = o.Object_Id
                WHERE o.Object_Id = ? AND s.Group_Id = ?";
        return $this->db->select($sql, [$object_id, $group_id]);
    }

    // Lưu điểm danh
    public function saveAttendance($data) {
        try {
            // Kiểm tra xem đã có điểm danh cho sinh viên này trong ngày chưa
            $check_sql = "SELECT * FROM tbl_attendance 
                         WHERE Student_Id = ? AND Object_Id = ? AND Group_Id = ? AND Date = ?";
            $params = [
                $data['Student_Id'],
                $data['Object_Id'],
                $data['Group_Id'],
                $data['Date']
            ];
            
            $existing = $this->db->select($check_sql, $params);

            if (!empty($existing)) {
                // Nếu đã có, cập nhật
                $updateData = [
                    'Status' => $data['Status']
                ];
                $condition = "Student_Id = '{$data['Student_Id']}' AND Object_Id = '{$data['Object_Id']}' 
                             AND Group_Id = '{$data['Group_Id']}' AND Date = '{$data['Date']}'";
                return $this->db->update('tbl_attendance', $updateData, $condition);
            } else {
                // Nếu chưa có, thêm mới
                $insertData = [
                    'Student_Id' => $data['Student_Id'],
                    'Object_Id' => $data['Object_Id'],
                    'Group_Id' => $data['Group_Id'],
                    'Status' => $data['Status'],
                    'Date' => $data['Date']
                ];
                return $this->db->insert('tbl_attendance', $insertData);
            }
        } catch (Exception $e) {
            error_log("Error saving attendance: " . $e->getMessage());
            return false;
        }
    }

    // Lấy trạng thái điểm danh của một lớp trong một ngày
    public function getAttendanceByDate($object_id, $group_id, $date) {
        $sql = "SELECT a.*, s.Name_std 
                FROM tbl_attendance a
                INNER JOIN tbl_student s ON a.Student_Id = s.Student_Id
                WHERE a.Object_Id = ? AND a.Group_Id = ? AND a.Date = ?";
        return $this->db->select($sql, [$object_id, $group_id, $date]);
    }
}
?> 