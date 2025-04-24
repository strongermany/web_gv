<?php
    class LessionModel extends DModel {
        public function __construct() {
            parent::__construct();
        }

        public function getAllLessons($table) {
            $sql = "SELECT * FROM $table ORDER BY Lession_Id DESC";
            return $this->db->select($sql);
        }

        public function getLessonById($table, $id) {
            $sql = "SELECT * FROM $table WHERE Lession_Id = ?";
            return $this->db->select($sql, [$id]);
        }

        public function addLesson($table, $data) {
            return $this->db->insert($table, $data);
        }

        public function updateLesson($table, $data, $id) {
            $cond = "Lession_Id = $id";
            return $this->db->update($table, $data, $cond);
        }

        public function deleteLesson($table, $id) {
            $cond = "Lession_Id = $id";
            return $this->db->delete($table, $cond);
        }

        public function getLessonsByTeacher($table, $teacher_id) {
            $sql = "SELECT * FROM $table WHERE Object_Id = ? ORDER BY Lession_Id DESC";
            return $this->db->select($sql, [$teacher_id]);
        }

        public function getLessonsBySubject($table, $subject_id) {
            $sql = "SELECT * FROM $table WHERE Object_Id = ? ORDER BY Lession_Id DESC";
            return $this->db->select($sql, [$subject_id]);
        }

        public function getAllGroups() {
            $sql = "SELECT *Name_class FROM tbl_object ORDER BY Object_Id ASC";
            return $this->db->select($sql);
        }
    }
?> 