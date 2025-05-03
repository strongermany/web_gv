<?php require_once 'apps/Views/header.php'; ?>

<div class="edit-news-container">
    <div class="edit-news-header">
        <h2>Chỉnh sửa tin tức</h2>
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

    <div class="edit-news-form">
        <form action="<?php echo Base_URL; ?>EditNewsController/update/<?php echo $data['news']['news_id']; ?>" method="POST" enctype="multipart/form-data" id="newsForm">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" id="title" name="title" value="<?php echo $data['news']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea id="content" name="content" required><?php echo $data['news']['content']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="category">Danh mục</label>
                <select id="category" name="category" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?php echo $category['category_name']; ?>" <?php echo $category['category_name'] == $data['news']['category'] ? 'selected' : ''; ?>>
                            <?php echo $category['category_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <div class="current-image">
                    <img src="<?php echo Base_URL; ?>public/images/news/<?php echo $data['news']['image_url']; ?>" 
                         alt="Current News Image" 
                         style="width: 200px; height: auto; margin-bottom: 10px;">
                </div>
                <input type="file" id="image" name="image" accept="image/*">
                <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
            </div>

            <div class="form-group">
                <label for="link_url">Đường dẫn liên kết</label>
                <input type="url" id="link_url" name="link_url" value="<?php echo $data['news']['link_url']; ?>">
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

<!-- Add CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
            language: 'vi'
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error(error);
        });

    // Ensure form submission works with CKEditor
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        // The form will automatically include the CKEditor content
        // No additional handling needed as CKEditor automatically updates the textarea
    });
</script>


<style>
.edit-news-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.edit-news-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.edit-news-header h2 {
    margin: 0;
    color: #333;
}

.edit-news-form {
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
.form-group input[type="url"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group textarea {
    resize: vertical;
    min-height: 150px;
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

@media (max-width: 768px) {
    .edit-news-container {
        margin: 10px;
        padding: 15px;
    }
}
</style>

