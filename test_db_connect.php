<?php
$host = "127.0.0.1"; // Địa chỉ MySQL
$dbname = "coffee_web"; // Thay bằng tên database của bạn
$user = "root"; // Laragon mặc định là 'root'
$pass = ""; // Laragon không có mật khẩu mặc định
// local host/coffee_web/te...

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Kết nối thành công!";
} catch (PDOException $e) {
    echo "❌ Lỗi kết nối: " . $e->getMessage();
}
?>
