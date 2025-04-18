<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/student.css" />

<section class="students">
    <h1>DANH SÁCH SINH VIÊN</h1>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert <?php echo $_GET['message'] === 'success' ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $_GET['message'] === 'success' ? 'Điểm danh đã được lưu thành công!' : 'Có lỗi xảy ra khi lưu điểm danh!'; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo Base_URL ?>ListClassController/saveAttendance" method="POST">
        <input type="hidden" name="object_id" value="<?php echo htmlspecialchars($object_id); ?>">
        <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($group_id); ?>">
        
        <div class="attendance-date">
            Ngày: <?php echo date('d/m/Y'); ?>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>Mã số sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Mã số lớp</th>
                    <th>Email</th>
                    <th>Điểm danh</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($std)) : ?>
                    <?php foreach ($std as $student) : ?>
                        <?php
                        // Tìm trạng thái điểm danh hiện tại của sinh viên
                        $current_status = null;
                        if (!empty($attendance)) {
                            foreach ($attendance as $att) {
                                if ($att['Student_Id'] === $student['Student_Id']) {
                                    $current_status = $att['Status'];
                                    break;
                                }
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo isset($student['Student_Id']) ? htmlspecialchars($student['Student_Id']) : ''; ?></td>
                            <td><?php echo isset($student['Name_std']) ? htmlspecialchars($student['Name_std']) : ''; ?></td>
                            <td><?php echo isset($student['Group_Id']) ? htmlspecialchars($student['Group_Id']) : ''; ?></td>
                            <td><?php echo isset($student['Email_std']) ? htmlspecialchars($student['Email_std']) : ''; ?></td>
                            <td class="attendance-cell">
                                <div class="attendance-options">
                                    <label>
                                        <input type="radio" 
                                               name="attendance[<?php echo $student['Student_Id']; ?>]" 
                                               value="1" 
                                               <?php echo $current_status === '1' ? 'checked' : ''; ?> 
                                               required>
                                        Có mặt
                                    </label>
                                    <label>
                                        <input type="radio" 
                                               name="attendance[<?php echo $student['Student_Id']; ?>]" 
                                               value="0" 
                                               <?php echo $current_status === '0' ? 'checked' : ''; ?> 
                                               required>
                                        Vắng
                                    </label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="no-data">Không có sinh viên nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="save-button-container">
            <button type="submit" class="save-button">Lưu điểm danh</button>
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Chỉ lấy các hàng chứa thông tin sinh viên (trong tbody)
        const studentRows = document.querySelector('tbody').querySelectorAll('tr:not(.no-data)');
        let allChecked = true;
        
        studentRows.forEach(function(row) {
            const radios = row.querySelectorAll('input[type="radio"]:checked');
            if (radios.length === 0) {
                allChecked = false;
            }
        });
        
        if (!allChecked) {
            alert('Vui lòng điểm danh đầy đủ cho tất cả sinh viên!');
            return;
        }
        
        // Nếu đã điểm danh đủ, submit form
        form.submit();
    });
});
</script>