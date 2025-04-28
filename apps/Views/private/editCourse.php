<?php require_once 'apps/Views/header.php'; ?>

<div class="edit-course-container">
    <div class="edit-course-header">
        <h2>Chỉnh sửa khóa học</h2>
        <a href="<?php echo Base_URL; ?>PrivateController" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <div class="edit-course-form">
        <form action="<?php echo Base_URL; ?>EditCourseController/update/<?php echo $data['course']['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Tên khóa học</label>
                <input type="text" id="title" name="title" value="<?php echo $data['course']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="instructor">Giảng viên</label>
                <input type="text" id="instructor" name="instructor" value="<?php echo $data['course']['instructor']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả khóa học</label>
                <textarea id="description" name="description" rows="4" required><?php echo $data['course']['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh khóa học</label>
                <div class="current-image">
                    <img src="<?php echo Base_URL; ?>public/images/courses/<?php echo $data['course']['image']; ?>" 
                         alt="Current Course Image" 
                         style="width: 200px; height: auto; margin-bottom: 10px;">
                </div>
                <input type="file" id="image" name="image" accept="image/*">
                <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="original_price">Giá gốc (VNĐ)</label>
                    <input type="number" id="original_price" name="original_price" 
                           value="<?php echo $data['course']['original_price']; ?>" required min="0">
                </div>
                <div class="form-group col-md-6">
                    <label for="discount">Giảm giá (%)</label>
                    <input type="number" id="discount" name="discount" 
                           value="<?php echo $data['course']['discount']; ?>" min="0" max="100">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="rating">Đánh giá</label>
                    <input type="number" id="rating" name="rating" 
                           value="<?php echo $data['course']['rating']; ?>" min="0" max="5" step="0.1">
                </div>
                <div class="form-group col-md-6">
                    <label for="rating_count">Số lượt đánh giá</label>
                    <input type="number" id="rating_count" name="rating_count" 
                           value="<?php echo $data['course']['rating_count']; ?>" min="0">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu thay đổi
                </button>
                <a href="<?php echo Base_URL; ?>PrivateController" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.edit-course-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.edit-course-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.edit-course-header h2 {
    margin: 0;
    color: #333;
}

.edit-course-form {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row .form-group {
    flex: 1;
    margin-bottom: 0;
}

.current-image {
    margin-bottom: 15px;
}

.current-image img {
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 30px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-primary {
    background: #4a90e2;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn:hover {
    opacity: 0.9;
}

.form-text {
    color: #6c757d;
    font-size: 12px;
    margin-top: 5px;
}

@media (max-width: 768px) {
    .edit-course-container {
        margin: 10px;
        padding: 15px;
    }

    .form-row {
        flex-direction: column;
        gap: 0;
    }

    .form-row .form-group {
        margin-bottom: 20px;
    }
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
</style>

<?php require_once 'apps/Views/footer.php'; ?> 