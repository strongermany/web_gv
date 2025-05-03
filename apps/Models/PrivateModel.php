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

    public function getAllCategories() {
        $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY sort_order, category_name";
        return $this->db->select($sql);
    }

    public function getCategoryById($id) {
        $table = "categories";
        $cond = "category_id=:id";
        $data = [':id' => $id];
        return $this->db->select($table, $cond, $data);
    }

    public function addCategory($data) {
        $table = "categories";
        $data = [
            'category_name' => $data['category_name'],
            'category_code' => $data['category_code']
        ];
        return $this->db->insert($table, $data);
    }

    public function updateCategory($data) {
        $table = "categories";
        $cond = "category_id=:id";
        $data = [
            'category_name' => $data['category_name'],
            'category_code' => $data['category_code'],
            'id' => $data['category_id']
        ];
        return $this->db->update($table, $data, $cond);
    }

    public function deleteCategory($id) {
        $table = "categories";
        $cond = "category_id=:id";
        $data = [':id' => $id];
        return $this->db->delete($table, $cond, $data);
    }

    // Slider Management Methods
    public function getAllSliderItems() {
        $sql = "SELECT si.*, c.category_name, c.category_code
                FROM slider_items si 
                LEFT JOIN categories c ON si.category_id = c.category_id 
                WHERE si.status = 1 
                ORDER BY si.created_at DESC";
        return $this->db->select($sql);
    }

    public function getSliderItemById($id) {
        $sql = "SELECT * FROM slider_items WHERE item_id = :id";
        $data = ['id' => $id];
        return $this->db->select($sql, $data);
    }

    public function addSliderItem($data) {
        $table = "slider_items";
        $data = [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'image_url' => $data['image_url'],
            'link_url' => $data['link_url'],
            'status' => $data['status'] ?? 1
        ];
        return $this->db->insert($table, $data);
    }

    public function updateSliderItem($data) {
        $table = "slider_items";
        $cond = "item_id = :item_id";
        $params = [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'image_url' => $data['image_url'],
            'link_url' => $data['link_url'],
            'status' => $data['status'] ?? 1,
            'item_id' => $data['item_id']
        ];
        return $this->db->update($table, $params, $cond);
    }

    public function deleteSliderItem($id) {
        $table = "slider_items";
        $cond = "item_id = :id";
        $data = [':id' => $id];
        return $this->db->delete($table, $cond, $data);
    }

    // News Management Methods
    public function getAllNews() {
        $sql = "SELECT * FROM tbl_news";
        return $this->db->select($sql);
    }

    public function getNewsById($id) {
        $sql = "SELECT * FROM tbl_news WHERE news_id = :id";
        $data = [':id' => $id];
        return $this->db->select($sql, $data);
    }

    public function addNews($data) {
        $table = "tbl_news";
        $insertData = [
            'title' => $data['title'],
            'content' => $data['content'],
            'category' => $data['category'],
            'link_url' => isset($data['link_url']) ? $data['link_url'] : null,
            'image_url' => isset($data['image_url']) ? $data['image_url'] : null
        ];
        return $this->db->insert($table, $insertData);
    }

    public function updateNews($id, $data) {
        $table = "tbl_news";
        $cond = "news_id = :news_id";
        $updateData = [
            'title' => $data['title'],
            'content' => $data['content'],
            'category' => $data['category'],
            'link_url' => $data['link_url'],
            'news_id' => $id
        ];
        if (isset($data['image_url'])) {
            $updateData['image_url'] = $data['image_url'];
        }
        return $this->db->update($table, $updateData, $cond);
    }

    public function deleteNews($id) {
        $table = "tbl_news";
        $cond = "news_id = :id";
        $data = [':id' => $id];
        return $this->db->delete($table, $cond, $data);
    }

    public function toggleNewsStatus($id) {
        $table = "tbl_news";
        $cond = "news_id = :id";
        $data = [
            'status' => 'NOT status',
            'id' => $id
        ];
        return $this->db->update($table, $data, $cond);
    }

    public function getAdminStats($adminId) {
        // Get admin statistics including total classes and attendance
        $sql = "SELECT 
                (SELECT COUNT(DISTINCT Group_Id) 
                 FROM tbl_group) as total_classes,
                
                (SELECT COUNT(DISTINCT Student_Id) 
                 FROM tbl_student) as total_students,
                
                (SELECT COUNT(*) 
                 FROM tbl_attendance 
                 WHERE Status = 1) as attended_classes,
                
                (SELECT COUNT(*) 
                 FROM tbl_attendance 
                 WHERE Status = 0) as absent_classes";
        
        return $this->db->select($sql);
    }

    public function getAdminClasses($adminId) {
        // Get all groups/classes with their details and student count
        $sql = "SELECT g.*, o.Name_class, o.Object_Id as Class_Id,
                (SELECT COUNT(*) FROM tbl_student s WHERE s.Group_Id = g.Group_Id) as total_students
                FROM tbl_group g 
                JOIN tbl_object o ON g.Object_Id = o.Object_Id
                WHERE g.Admin_Id = :adminId
                ORDER BY g.Group_Id";
        
        return $this->db->select($sql, [':adminId' => $adminId]);
    }

    // Course Management Methods
    public function getAllCourses() {
        $sql = "SELECT * FROM courses ORDER BY id DESC";
        $result = $this->db->select($sql, [], PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function getCourseById($id) {
        try {
            $sql = "SELECT * FROM courses WHERE id = :id LIMIT 1";
            $params = [':id' => $id];
            $result = $this->db->select($sql, $params, PDO::FETCH_ASSOC);
            
            // Debug: Kiểm tra kết quả truy vấn
            error_log("SQL Query: " . $sql);
            error_log("Params: " . print_r($params, true));
            error_log("Query Result: " . print_r($result, true));
            
            return !empty($result) ? $result[0] : false;
        } catch (Exception $e) {
            error_log("Error in getCourseById: " . $e->getMessage());
            return false;
        }
    }

    public function addCourse($data) {
        $table = "courses";
        $insertData = [
            'title' => $data['title'],
            'instructor' => $data['instructor'],
            'description' => $data['description'],
            'original_price' => $data['original_price'],
            'discount' => $data['discount'],
            'discounted_price' => $data['discounted_price'],
            'image' => isset($data['image']) ? $data['image'] : null,
            'rating' => isset($data['rating']) ? $data['rating'] : 0,
            'rating_count' => isset($data['rating_count']) ? $data['rating_count'] : 0
        ];
        return $this->db->insert($table, $insertData);
    }

    public function updateCourse($id, $data) {
        try {
            $cond = "id = :id";
            $data['id'] = $id;
            return $this->db->update('courses', $data, $cond);
        } catch (Exception $e) {
            error_log("Error updating course: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCourse($id) {
        try {
            $cond = "id = :id";
            return $this->db->delete('courses', $cond, ['id' => $id]);
        } catch (Exception $e) {
            error_log("Error deleting course: " . $e->getMessage());
            return false;
        }
    }

    // Cập nhật trạng thái khóa học
    public function updateCourseStatus($id, $status) {
        $table = "courses";
        $updateData = [
            'status' => $status,
            'id' => $id
        ];
        $cond = "id = :id";
        return $this->db->update($table, $updateData, $cond);
    }

    // Tìm kiếm khóa học
    public function searchCourses($keyword) {
        $sql = "SELECT * FROM courses 
                WHERE title LIKE :keyword 
                OR instructor LIKE :keyword 
                OR description LIKE :keyword
                ORDER BY id DESC";
        $params = [':keyword' => '%' . $keyword . '%'];
        return $this->db->select($sql, $params, PDO::FETCH_ASSOC);
    }

    // Lấy khóa học theo trạng thái
    public function getCoursesByStatus($status) {
        $sql = "SELECT * FROM courses WHERE status = :status ORDER BY created_at DESC";
        return $this->db->select($sql, [':status' => $status], PDO::FETCH_ASSOC);
    }

    // Cập nhật đánh giá khóa học
    public function updateCourseRating($id, $rating) {
        $course = $this->getCourseById($id);
        if (!$course) {
            return false;
        }

        $currentRating = floatval($course['rating']);
        $currentCount = intval($course['rating_count']);
        
        // Tính toán rating mới
        $newCount = $currentCount + 1;
        $newRating = (($currentRating * $currentCount) + $rating) / $newCount;
        
        $table = "courses";
        $updateData = [
            'rating' => number_format($newRating, 2),
            'rating_count' => $newCount,
            'id' => $id
        ];
        $cond = "id = :id";
        
        return $this->db->update($table, $updateData, $cond);
    }

    // Lấy khóa học nổi bật (rating cao)
    public function getFeaturedCourses($limit = 6) {
        $sql = "SELECT * FROM courses 
                ORDER BY rating DESC, rating_count DESC 
                LIMIT :limit";
        return $this->db->select($sql, [':limit' => $limit], PDO::FETCH_ASSOC);
    }

    // Lấy khóa học mới nhất
    public function getLatestCourses($limit = 6) {
        $sql = "SELECT * FROM courses 
                ORDER BY id DESC 
                LIMIT :limit";
        return $this->db->select($sql, [':limit' => $limit], PDO::FETCH_ASSOC);
    }

    // Đếm tổng số khóa học
    public function countCourses() {
        $sql = "SELECT COUNT(*) as total FROM courses";
        $result = $this->db->select($sql, [], PDO::FETCH_ASSOC);
        return $result[0]['total'];
    }
} 