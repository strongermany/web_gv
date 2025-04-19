<?php require_once 'apps/Views/header.php'; ?>

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
                    <?php foreach ($data['classes'] as $class): ?>
                        <div class="class-card">
                            <h3><?php echo $class['Name_class']; ?></h3>
                            <p>Nhóm: <?php echo $class['Group_Id']; ?></p>
                            <p>Mã lớp: <?php echo $class['Class_Id']; ?></p>
                            <p>Tổng số học sinh: <?php echo $class['total_students']; ?></p>
                            <div class="class-actions">
                                <a href="<?php echo Base_URL; ?>ListClassController/listClass/<?php echo $class['Object_Id']; ?>/<?php echo $class['Group_Id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
</script>

<style>
.admin-info-header {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.admin-avatar {
    margin-right: 30px;
    position: relative;
}

.admin-avatar img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}

.change-avatar-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #4a90e2;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s;
}

.change-avatar-btn:hover {
    background: #357abd;
}

.avatar-form {
    position: absolute;
    bottom: 0;
    right: 0;
}

.admin-details h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.admin-role {
    color: #666;
    margin: 5px 0;
    font-size: 16px;
}

.admin-contact {
    display: flex;
    gap: 20px;
    margin: 10px 0;
}

.admin-contact span {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #666;
}

.admin-contact i {
    color: #4a90e2;
}

.admin-status {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 10px;
}

.status-tag {
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
}

.status-tag.active {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.status-tag.inactive {
    background-color: #ffebee;
    color: #c62828;
}

.last-login {
    color: #666;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.last-login i {
    color: #4a90e2;
}
</style>



