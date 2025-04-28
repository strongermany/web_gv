<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/styles.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/profile.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/slider.css?v=<?php echo time(); ?>" />
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
                    <li><a href="<?php echo Base_URL ?>LessionController">BÀI GIẢNG</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-trigger">ĐIỂM DANH</a>
                        <div class="dropdown-menu">
                            <?php if (!empty($list)): ?>
                                <?php foreach($list as $class): ?>
                                    <a href="<?php echo Base_URL ?>ListClassController/listClass/<?php echo $class['Object_Id'] ?>/<?php echo $class['Group_Id'] ?>">
                                        <?php echo htmlspecialchars($class['Name_class']); ?> - Nhóm <?php echo $class['Group_Id']; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="no-classes">Không có lớp nào</span>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li><a href="">Lịch Dạy </a></li>
                    <li class="admin-profile">
                        <?php if(Session::get('login')): ?>
                            <img src="<?php echo Base_URL ?>public/images/avatars/<?php echo isset($data['admin']->avatar) ? $data['admin']->avatar : 'avatar.jpg'; ?>" alt="Admin Avatar" onclick="toggleDropdown(event)">
                            <div class="profile-dropdown">
                                <a href="<?php echo Base_URL ?>PrivateController"><i class="fa-solid fa-key"></i>Thông tin cá nhân</a>
                                <?php if(isset($data['admin']->Last_login)): ?>
                                <?php endif; ?>
                                <a href="<?php echo Base_URL ?>index/logout"><i class="fa-solid fa-right-from-bracket"></i> đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo Base_URL ?>index/login" class="login-btn"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>
      
    </section>

    <!-- Add scripts.js at the end of body -->
    <script src="<?php echo Base_URL ?>public/js/scripts.js"></script>
    <script src="<?php echo Base_URL ?>public/js/profile.js"></script>
</body>
</html>