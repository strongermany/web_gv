<!-- Include CSS -->
<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/notify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo Base_URL ?>apps/Views/lession/edit.css">

<div class="container">
    <!-- Search and Filter Section -->
    <div class="search-section">
        <div class="search-row">
            <div class="search-col">
                <input type="text" class="search-input" placeholder="Tìm kiếm bài giảng...">
            </div>
        </div>
    </div>

    <!-- Lessons Table Section -->
    <div class="section-header">
        <h2 class="section-title">Danh sách bài giảng</h2>
        <button type="button" class="btn btn-primary" onclick="openModal('addLessonModal')">
            <i class="fas fa-plus"></i> Thêm bài giảng mới
        </button>
    </div>

    <table class="lessons-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên bài giảng</th>
                <th>Tên lớp </th>
                <th>File</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lessions)): ?>
                <?php foreach($lessions as $lession): ?>
                <tr>
                    <td><?php echo $lession['Lession_Id']; ?></td>
                    <td><?php echo $lession['Name_ls']; ?></td>
                    <td><?php echo $lession['Name_object']; ?></td>
                    <td>
                        <?php if($lession['File_Name']): ?>
                            <a href="<?php echo Base_URL; ?>public/uploads/<?php echo $lession['File_Path']; ?>" target="_blank">
                                <?php echo $lession['File_Name']; ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Không có file</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $lession['Description']; ?></td>
                    <td>
                        <div class="action-buttons">
                           
                            <a href="<?php echo Base_URL; ?>LessionController/edit/<?php echo $lession['Lession_Id']; ?>" 
                               class="btn btn-warning" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo Base_URL; ?>LessionController/delete/<?php echo $lession['Lession_Id']; ?>" 
                               class="btn btn-danger" title="Xóa"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="empty-state">
                            <i class="fas fa-book-open fa-3x mb-3"></i>
                            <p>Chưa có bài giảng nào</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add Lesson Modal -->
<div id="addLessonModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Thêm bài giảng mới</h5>
            <span class="close-button" onclick="closeModal('addLessonModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="<?php echo Base_URL; ?>LessionController/add" method="POST" enctype="multipart/form-data" id="addLessonForm">
                <div class="form-group">
                    <label class="form-label">Tên bài giảng</label>
                    <input type="text" name="Name_ls" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tên Lớp</label>
                    <select name="Object_Id" class="form-control" required onchange="updateObjectName(this)">
                        <option value="">Chọn lớp</option>
                        <?php if (!empty($classes)): ?>
                            <?php foreach($classes as $class): ?>
                                <option value="<?php echo $class['Object_Id']; ?>" data-name="<?php echo htmlspecialchars($class['Name_class']); ?>">
                                    <?php echo htmlspecialchars($class['Name_class']); ?> - Nhóm <?php echo $class['Group_Id']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <input type="hidden" name="Name_object" id="Name_object">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mô tả</label>
                    <textarea name="Description" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tệp đính kèm</label>
                    <div class="file-upload" onclick="triggerFileInput()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Kéo thả file vào đây hoặc click để chọn file</p>
                        <input type="file" name="lesson_file" id="fileInput" class="file-input" style="display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addLessonModal')">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include JavaScript -->
<script src="<?php echo Base_URL ?>apps/Views/lession/edit.js"></script>