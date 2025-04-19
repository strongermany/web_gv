<?php require_once 'apps/Views/header.php'; ?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            <img src="<?php echo Base_URL ?>public/images/avatar.jpg" alt="Admin Avatar">
            <button class="change-avatar-btn">
                <i class="fas fa-camera"></i>
            </button>
        </div>
        <div class="profile-info">
            <h1><?php echo $data['admin']->Admin_name; ?></h1>
            <p class="role"><?php echo $data['admin']->Role; ?></p>
            <div class="contact-info">
                <span><i class="fas fa-id-badge"></i> <?php echo $data['admin']->Admin_Id; ?></span>
                <span><i class="fas fa-envelope"></i> <?php echo $data['admin']->Email; ?></span>
                <span><i class="fas fa-phone"></i> <?php echo $data['admin']->Phone; ?></span>
            </div>
            <div class="status-info">
                <span class="status-badge <?php echo $data['admin']->Status ? 'active' : 'inactive'; ?>">
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
                            <h3><?php echo $class->Name_class; ?></h3>
                            <p>Nhóm: <?php echo $class->Group_Id; ?></p>
                            <p>Mã lớp: <?php echo $class->Class_Id; ?></p>
                            <div class="class-actions">
                                <a href="<?php echo Base_URL; ?>ListClassController/listClass/<?php echo $class->Object_Id; ?>/<?php echo $class->Group_Id; ?>" class="btn btn-primary">Xem chi tiết</a>
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

<?php require_once 'apps/Views/footer.php'; ?>

