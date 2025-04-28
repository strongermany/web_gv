<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thời khóa biểu giảng dạy</title>
    <link rel="stylesheet" href="<?php echo Base_URL; ?>public/css/timetable.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="timetable-container">
        <h1>Thời khóa biểu giảng dạy</h1>
        <table class="timetable">
            <thead>
                <tr>
                    <th>Thứ</th>
                    <th>Tiết</th>
                    <th>Môn học</th>
                    <th>Lớp</th>
                    <th>Phòng</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Thứ 2</td>
                    <td>1-3</td>
                    <td>Xác suất thống kê</td>
                    <td>20IT1</td>
                    <td>B201</td>
                    <td>07:00</td>
                    <td>09:30</td>
                </tr>
                <tr>
                    <td>Thứ 3</td>
                    <td>4-6</td>
                    <td>Lập trình C++</td>
                    <td>20IT2</td>
                    <td>B202</td>
                    <td>09:40</td>
                    <td>12:00</td>
                </tr>
                <tr>
                    <td>Thứ 5</td>
                    <td>1-3</td>
                    <td>Cơ sở dữ liệu</td>
                    <td>20IT3</td>
                    <td>B203</td>
                    <td>07:00</td>
                    <td>09:30</td>
                </tr>
                <!-- Thêm các dòng khác nếu cần -->
            </tbody>
        </table>
    </div>
</body>
</html> 