<!-- Include CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo Base_URL ?>apps/Views/lession/edit.css">

<div class="container">
    <div class="edit-lesson-container">
        <div class="edit-lesson-header">
            <h2>Chỉnh sửa bài giảng</h2>
            <a href="<?php echo Base_URL; ?>LessionController" class="back-link">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <form action="<?php echo Base_URL; ?>LessionController/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="Lession_Id" value="<?php echo $lession[0]['Lession_Id']; ?>">
            
            <div class="form-group">
                <label class="form-label">Tên bài giảng</label>
                <input type="text" name="Name_ls" class="form-control" 
                       value="<?php echo htmlspecialchars($lession[0]['Name_ls']); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tên Lớp</label>
                <select name="Object_Id" class="form-control" required onchange="updateObjectName(this)">
                    <option value="">Chọn lớp</option>
                    <?php if (!empty($classes)): ?>
                        <?php foreach($classes as $class): ?>
                            <option value="<?php echo $class['Object_Id']; ?>" 
                                    data-name="<?php echo htmlspecialchars($class['Name_class']); ?>"
                                    <?php echo ($class['Object_Id'] == $lession[0]['Object_Id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($class['Name_class']); ?> - Nhóm <?php echo $class['Group_Id']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <input type="hidden" name="Name_object" id="Name_object" value="<?php echo htmlspecialchars($lession[0]['Name_object']); ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Mô tả</label>
                <textarea name="Description" class="form-control" rows="5"><?php echo htmlspecialchars($lession[0]['Description']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">File hiện tại</label>
                <?php if($lession[0]['File_Name']): ?>
                    <div class="current-file">
                        <i class="fas fa-file"></i>
                        <a href="<?php echo Base_URL; ?>public/uploads/<?php echo $lession[0]['File_Path']; ?>" target="_blank">
                            <?php echo $lession[0]['File_Name']; ?>
                        </a>
                    </div>
                <?php else: ?>
                    <p class="no-file">Không có file</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Cập nhật file mới (nếu cần)</label>
                <div class="file-upload" onclick="triggerFileInput()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Kéo thả file vào đây hoặc click để chọn file</p>
                    <input type="file" name="lesson_file" id="fileInput" class="file-input" style="display: none;">
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-cancel" onclick="window.location.href='<?php echo Base_URL; ?>LessionController'">Hủy</button>
                <button type="submit" class="btn btn-save">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

<!-- Include JavaScript -->
<script src="<?php echo Base_URL ?>apps/Views/lession/edit.js"></script> 