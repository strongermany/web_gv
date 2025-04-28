<?php require_once 'apps/Views/header.php'; ?>
<link rel="stylesheet" href="<?php echo Base_URL?>public/css/profile.css">

<div class="profile-container">
    <div class="admin-info-header">
        <div class="admin-avatar">
            <img src="<?php echo Base_URL ?>public/images/avatars/<?php echo isset($data['admin']->avatar) ? $data['admin']->avatar : 'avatar.jpg'; ?>" alt="Admin Avatar">
            <form action="<?php echo Base_URL; ?>PrivateController/updateAvatar" method="POST" enctype="multipart/form-data" class="avatar-form">
                <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none;">
                <label for="avatar" class="change-avatar-btn">
                    <i class="fas fa-camera"></i>
                </label>
            </form>
        </div>
        <div class="admin-details">
            <h2><?php echo $data['admin']->Admin_name; ?></h2>
            <p class="admin-role"><?php echo strtolower($data['admin']->Role); ?></p>
            <div class="admin-contact">
                <span><i class="fas fa-id-badge"></i> <?php echo $data['admin']->Admin_Id; ?></span>
                <span><i class="fas fa-envelope"></i> <?php echo $data['admin']->Email; ?></span>
                <span><i class="fas fa-phone"></i> <?php echo $data['admin']->Phone; ?></span>
            </div>
            <div class="admin-status">
                <span class="status-tag <?php echo $data['admin']->Status ? 'active' : 'inactive'; ?>">
                    <?php echo $data['admin']->Status ? 'Đang hoạt động' : 'Không hoạt động'; ?>
                </span>
                <span class="last-login">
                    <i class="fas fa-clock"></i> 
                    Đăng nhập lần cuối: <?php echo $data['admin']->Last_login ? date('d/m/Y H:i', strtotime($data['admin']->Last_login)) : 'Chưa đăng nhập'; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-stats">
            <div class="stat-card">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3><?php echo $data['stats']->total_classes; ?></h3>
                <p>Tổng số lớp</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-user-check"></i>
                <h3><?php echo $data['stats']->attended_classes; ?></h3>
                <p>Lớp đã điểm danh</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-user-times"></i>
                <h3><?php echo $data['stats']->absent_classes; ?></h3>
                <p>Lớp vắng mặt</p>
            </div>
        </div>

        <div class="profile-tabs">
            <button class="tab-btn active" data-tab="info">Thông tin cá nhân</button>
            <button class="tab-btn" data-tab="classes">Lớp đang dạy</button>
            <button class="tab-btn" data-tab="password">Đổi mật khẩu</button>
            <button class="tab-btn" data-tab="slider">Quản lý slider</button>
            <button class="tab-btn" data-tab="news">Quản lý tin tức</button>
            <button class="tab-btn" data-tab="courses">Quản lý khóa học</button>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="info">
                <form action="<?php echo Base_URL; ?>PrivateController/updateProfile" method="POST" class="profile-form">
                    <div class="form-group">
                        <label for="admin_name">Tên quản trị viên</label>
                        <input type="text" id="admin_name" name="admin_name" value="<?php echo $data['admin']->Admin_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $data['admin']->Email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $data['admin']->Phone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="role">Vai trò</label>
                        <select id="role" name="role" required>
                            <option value="admin" <?php echo $data['admin']->Role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="super_admin" <?php echo $data['admin']->Role == 'super_admin' ? 'selected' : ''; ?>>Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select id="status" name="status" required>
                            <option value="1" <?php echo $data['admin']->Status == 1 ? 'selected' : ''; ?>>Đang hoạt động</option>
                            <option value="0" <?php echo $data['admin']->Status == 0 ? 'selected' : ''; ?>>Không hoạt động</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                </form>
            </div>

            <div class="tab-pane" id="classes">
                <div class="classes-list">
                    <div class="classes-grid">
                        <?php foreach ($data['classes'] as $class): ?>
                            <div class="class-card">
                                <h3><?php echo $class['Name_class']; ?></h3>
                                <p><strong>Nhóm:</strong> <?php echo $class['Group_Id']; ?></p>
                                <p><strong>Mã lớp:</strong> <?php echo $class['Class_Id']; ?></p>
                                <p><strong>Tổng số học sinh:</strong> <?php echo $class['total_students']; ?></p>
                                <div class="class-actions">
                                    <a href="<?php echo Base_URL; ?>ListClassController/listClass/<?php echo $class['Object_Id']; ?>/<?php echo $class['Group_Id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="password">
                <form action="<?php echo Base_URL; ?>PrivateController/changePassword" method="POST" class="password-form">
                    <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Xác nhận mật khẩu mới</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </form>
            </div>

            <div class="tab-pane" id="slider">
                <div class="slider-management">
                    <h3>Quản lý slider</h3>
                    <form action="<?php echo Base_URL; ?>PrivateController/addSliderItem" method="POST" enctype="multipart/form-data" class="slider-form">
                        <div class="form-group">
                            <label for="slider_category">Danh mục</label>
                            <select id="slider_category" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                <?php if (isset($data['categories']) && !empty($data['categories'])): ?>
                                    <?php foreach ($data['categories'] as $category): ?>
                                        <option value="<?php echo $category['category_id']; ?>">
                                            <?php echo $category['category_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slider_title">Tiêu đề</label>
                            <input type="text" id="slider_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="slider_content">Nội dung</label>
                            <textarea id="slider_content" name="content" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="slider_image">Hình ảnh</label>
                            <input type="file" id="slider_image" name="image" accept="image/*" required>
                            <small class="form-text text-muted">Kích thước khuyến nghị: 800x600px</small>
                        </div>
                        <div class="form-group">
                            <label for="slider_link">Liên kết (nếu có)</label>
                            <input type="url" id="slider_link" name="link_url">
                        </div>
                        <div class="form-group">
                            <label for="slider_status">Trạng thái</label>
                            <select id="slider_status" name="status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm slider</button>
                    </form>

                    <div class="slider-list">
                        <h4>Danh sách slider</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Liên kết</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data['sliderItems']) && !empty($data['sliderItems'])): ?>
                                        <?php foreach ($data['sliderItems'] as $item): ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo Base_URL; ?>public/images/slider/<?php echo $item['image_url']; ?>" 
                                                         alt="<?php echo $item['title']; ?>" 
                                                         style="width: 100px; height: auto;">
                                                </td>
                                                <td>
                                                    <?php 
                                                    $category = array_filter($data['categories'], function($cat) use ($item) {
                                                        return $cat['category_id'] == $item['category_id'];
                                                    });
                                                    echo !empty($category) ? reset($category)['category_name'] : 'N/A';
                                                    ?>
                                                </td>
                                                <td><?php echo $item['title']; ?></td>
                                                <td><?php echo $item['content']; ?></td>
                                                <td>
                                                    <?php if ($item['link_url']): ?>
                                                        <a href="<?php echo $item['link_url']; ?>">Xem</a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <select class="status-select" onchange="updateStatus(this, <?php echo $item['item_id']; ?>)">
                                                        <option value="1" <?php echo $item['status'] ? 'selected' : ''; ?>>Hiển thị</option>
                                                        <option value="0" <?php echo !$item['status'] ? 'selected' : ''; ?>>Ẩn</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="<?php echo Base_URL; ?>EditSliderController/index/<?php echo $item['item_id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Sửa</a>
                                                    <a href="<?php echo Base_URL; ?>PrivateController/deleteSliderItem/<?php echo $item['item_id']; ?>" 
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa slider này?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Chưa có slider nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="news">
                <div class="news-management">
                    <h3>Quản lý tin tức</h3>
                    <form action="<?php echo Base_URL; ?>PrivateController/addNews" method="POST" enctype="multipart/form-data" class="news-form">
                        <div class="form-group">
                            <label for="news_title">Tiêu đề</label>
                            <input type="text" id="news_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="news_category">Danh mục</label>
                            <select id="news_category" name="category" required>
                                <option value="">Chọn danh mục</option>
                                <?php if (isset($data['categories']) && !empty($data['categories'])): ?>
                                    <?php foreach ($data['categories'] as $category): ?>
                                        <option value="<?php echo $category['category_name']; ?>">
                                            <?php echo $category['category_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="news_content">Nội dung</label>
                            <textarea id="news_content" name="content" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="news_image">Hình ảnh</label>
                            <input type="file" id="news_image" name="image" accept="image/*">
                            <small class="form-text text-muted">Kích thước khuyến nghị: 800x600px</small>
                        </div>
                        <div class="form-group">
                            <label for="news_status">Trạng thái</label>
                            <select id="news_status" name="status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm tin tức</button>
                    </form>

                    <div class="news-list">
                        <h4>Danh sách tin tức</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data['newsItems'])): ?>
                                        <?php foreach ($data['newsItems'] as $news): ?>
                                            <tr>
                                                <td><?php echo $news['news_id']; ?></td>
                                                <td><?php echo isset($news['title']) ? $news['title'] : ''; ?></td>
                                                <td><?php echo isset($news['category']) ? $news['category'] : 'Chưa phân loại'; ?></td>
                                                <td>
                                                    <?php if (isset($news['status']) && $news['status'] == 1): ?>
                                                        <span class="badge badge-success">Hiển thị</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Ẩn</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo Base_URL; ?>EditNewsController/index/<?php echo isset($news['news_id']) ? $news['news_id'] : ''; ?>" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="<?php echo Base_URL; ?>PrivateController/deleteNews/<?php echo isset($news['news_id']) ? $news['news_id'] : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tin tức này?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                    <a href="<?php echo Base_URL; ?>PrivateController/toggleNewsStatus/<?php echo isset($news['news_id']) ? $news['news_id'] : ''; ?>" class="btn btn-sm btn-info">
                                                        <i class="fas fa-toggle-on"></i> <?php echo (isset($news['status']) && $news['status'] == 1) ? 'Ẩn' : 'Hiện'; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Chưa có tin tức nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="courses">
                <div class="courses-management">
                    <h3>Quản lý khóa học</h3>
                    <form action="<?php echo Base_URL; ?>PrivateController/addCourse" method="POST" enctype="multipart/form-data" class="course-form">
                        <div class="form-row">
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_title">Tên khóa học</label>
                                <input type="text" id="course_title" name="title" required>
                            </div>
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_instructor">Giảng viên</label>
                                <input type="text" id="course_instructor" name="instructor" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_price">Giá gốc</label>
                                <input type="number" id="course_price" name="original_price" required>
                            </div>
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_discount">Giảm giá (%)</label>
                                <input type="number" id="course_discount" name="discount" min="0" max="100" value="0">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_rating">Rating</label>
                                <input type="number" id="course_rating" name="rating" min="0" max="5" step="0.01" value="0">
                            </div>
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_rating_count">Số lượt đánh giá</label>
                                <input type="number" id="course_rating_count" name="rating_count" min="0" value="0">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_image">Hình ảnh khóa học</label>
                                <input type="file" id="course_image" name="image" accept="image/*" required>
                                <small class="form-text text-muted">Kích thước khuyến nghị: 800x600px</small>
                            </div>
                            <div class="form-group" style="flex:1; min-width: 250px;">
                                <label for="course_status">Trạng thái</label>
                                <select id="course_status" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="course_description">Mô tả khóa học</label>
                            <textarea id="course_description" name="description" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm khóa học</button>
                    </form>

                    <div class="courses-list">
                        <h4>Danh sách khóa học</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên khóa học</th>
                                        <th>Giảng viên</th>
                                        <th>Giá gốc</th>
                                        <th>Giảm giá</th>
                                        <th>Giá sau giảm</th>
                                        <th>Đánh giá</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data['courses']) && !empty($data['courses'])): ?>
                                        <?php foreach ($data['courses'] as $course): ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo Base_URL; ?>public/images/courses/<?php echo $course['image']; ?>" 
                                                         alt="<?php echo $course['title']; ?>" 
                                                         style="width: 100px; height: auto;">
                                                </td>
                                                <td><?php echo $course['title']; ?></td>
                                                <td><?php echo $course['instructor']; ?></td>
                                                <td><?php echo number_format($course['original_price']); ?>đ</td>
                                                <td><?php echo $course['discount']; ?>%</td>
                                                <td><?php echo number_format($course['discounted_price']); ?>đ</td>
                                                <td>
                                                    <?php echo $course['rating']; ?> 
                                                    <i class="fas fa-star" style="color: gold;"></i>
                                                    (<?php echo $course['rating_count']; ?> đánh giá)
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    <a href="<?php echo Base_URL; ?>EditCourseController/index/<?php echo $course['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Sửa</a>
                                                    <a href="<?php echo Base_URL; ?>PrivateController/deleteCourse/<?php echo $course['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')"><i class="fas fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Chưa có khóa học nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const profileHeader = document.querySelector('.profile-header');
    const profileAvatar = document.querySelector('.profile-avatar');
    const avatarInput = document.getElementById('avatar');
    const avatarForm = document.querySelector('.avatar-form');

    // Xử lý thay đổi avatar
    avatarInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            avatarForm.submit();
        }
    });

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');

            // Show/hide profile header and avatar based on active tab
            if (tabId === 'classes') {
                profileHeader.style.display = 'none';
                profileAvatar.style.display = 'none';
            } else {
                profileHeader.style.display = 'flex';
                profileAvatar.style.display = 'block';
            }
        });
    });
});

function updateStatus(select, itemId) {
    window.location.href = '<?php echo Base_URL; ?>PrivateController/toggleSliderStatus/' + itemId;
}
</script>





