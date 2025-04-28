CREATE TABLE timetable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    thu VARCHAR(10) NOT NULL,
    tiet VARCHAR(10) NOT NULL,
    mon_hoc VARCHAR(100) NOT NULL,
    lop VARCHAR(20) NOT NULL,
    phong VARCHAR(20) NOT NULL,
    bat_dau TIME NOT NULL,
    ket_thuc TIME NOT NULL
);

-- Ví dụ dữ liệu mẫu
INSERT INTO timetable (thu, tiet, mon_hoc, lop, phong, bat_dau, ket_thuc) VALUES
('Thứ 2', '1-3', 'Xác suất thống kê', '20IT1', 'B201', '07:00', '09:30'),
('Thứ 3', '4-6', 'Lập trình C++', '20IT2', 'B202', '09:40', '12:00'),
('Thứ 5', '1-3', 'Cơ sở dữ liệu', '20IT3', 'B203', '07:00', '09:30'); 