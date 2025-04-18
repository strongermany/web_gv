<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="<?php echo Base_URL ?>public/images/tdtulogo.webp" /></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="<?php echo Base_URL ?>HomeController">TRANG CHỦ</a></li>
                    <li><a href="<?php echo Base_URL ?>LessionController">THÔNG BÁO</a></li>
                    <li><a href="">ĐIỂM DANH</a></li>
                    <li><a href="">Lịch Dạy </a></li>
                    <li class="admin-profile">
                        <img src="<?php echo Base_URL ?>public/images/avatar.jpg" alt="Admin Avatar" onclick="toggleDropdown(event)">
                        <div class="profile-dropdown">
                            <a href="#"><i class="fa-solid fa-key"></i></a>
                            <a href="<?php echo Base_URL ?>index/logout"><i class="fa-solid fa-right-from-bracket"></i> đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Ton Duc Thang University</h1>
            <p>
                Trường Đại học Tôn Đức Thắng không ngừng phát triển vững mạnh, thông
                qua các hoạt động ghi nhận hàng năm <br />và kết quả xếp hạng, uy tín
                của cơ sở giáo dục trong cộng đồng xã hội, trên bản đồ giáo dục Việt
                Nam và thế giới.
            </p>
            <a href="" class="hero-btn">Visit Us</a>
        </div>
    </section>

    <!-- Add scripts.js at the end of body -->
    <script src="<?php echo Base_URL ?>public/js/scripts.js"></script>
</body>
</html>