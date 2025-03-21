<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Nhúng bootstrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/xxxxxxx.css">
    <link rel="stylesheet" href="<?php echo Base_URL?>public/css/style.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Coiny&family=Lora:ital,wght@0,400..700;1,400..700&family=Oswald:wght@200..700&family=Sigmar&display=swap" rel="stylesheet">

    <title>TRANG CHỦ</title>
  </head>
  <header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container p-3">
        <img src="<?php echo Base_URL?>public/images/logob.png" alt="" class="navbar-logo">
        <a class="navbar-brand fw-bold text-dark" href="#">HIPPO<br>COFFEE</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Trang chủ</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
            <li class="nav-item">
              <a class="nav-link" href="#">Đặt hàng</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="pagesDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Tư liệu
              </a>
              <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                <li><a class="dropdown-item" href="#">Phân biệt hạt cafe</a></li>
                <li><a class="dropdown-item" href="#">Lịch sử hình thành quán</a></li>
                <li>
                  <a class="dropdown-item" href="#">Quy trình sản xuất</a>
                </li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">Bài báo</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Cửa hàng</a></li>
            <li class="divider"></li>
            <li>
              <a href="#"><i class="material-icons icon-color">menu</i></a>
            </li>
          
        </div>
      </div>
    </nav>
  </header>

  <body>
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="image-container">
            <img src="<?php echo Base_URL?>public/images/BANNER1 (3).jpg" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="animate__animated animate__slideInDown" style="color:rgb(43, 110, 22)"><b>CAFE MỘC NGUYÊN CHẤT</b></h1>
              <h3 class="animate__animated animate__slideInDown">Trồng trọt - chế biến - thu hoạch từ vùng đất Tây Nguyên</h3>
              <button class="mt-3 p-4 px-5 btn font-weight-bold button-1 animate__animated animate__zoomIn">Xem thêm</button>
          </div>
        </div>
        </div>
        <div class="carousel-item">
          <div class="image-container">
            <img src="<?php echo Base_URL?>public/images/BANNER1 (2) - Sao chép.jpg" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="animate__animated animate__slideInDown" style="color:rgb(255, 162, 0)"><b>MENU ĐA DẠNG PHONG PHÚ</b></h1>
              <h3 class="animate__animated animate__slideInDown" style="color:rgb(255, 255, 255)">Nhiều món thức uống được pha chế từ sự kết hợp độc đáo</h3>
              <button class="mt-3 p-4 px-5 btn font-weight-bold button-1 animate__animated animate__zoomIn">Xem thêm</button>
          </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="image-container">
            <img src="<?php echo Base_URL?>public/images/BANNER1 (1).jpg" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1 class="animate__animated animate__slideInDown" style="color:rgb(213, 137, 65)"><b>TRẢI NGHIỆM VÀ GIÁ TRỊ</b></h1>
              <h3 class="animate__animated animate__slideInDown">Mang đến cho khách hàng sự chất lượng và hài lòng</h3>
              <button class="mt-3 p-4 px-5 btn font-weight-bold button-1 animate__animated animate__zoomIn">Xem thêm</button>
          </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  <div class="card-container">
    <div class="card">
      <img src="<?php echo Base_URL?>public/images/b1.jpg">
      <div class="card-content">
        <h3>CAFE SÁNG VÀ TẦM QUAN TRỌNG<h3>
        <a href="" class="btn">Đọc thêm</a>
      </div>
    </div>
    <div class="card">
      <img src="<?php echo Base_URL?>public/images/b2.jpg">
      <div class="card-content">
        <h3>THỨ 4 VUI VẺ - GIẢM GIÁ 30%<h3>
        <a href="" class="btn">Đọc thêm</a>
      </div>
    </div>
    <div class="card">
      <img src="<?php echo Base_URL?>public/images/BANNER1 (2).jpg">
      <div class="card-content">
        <h3>QUY TRÌNH SẢN XUẤT<h3>
        <a href="" class="btn">Đọc thêm</a>
      </div>
    </div>
  </div>
  <p class="text-b"><i>Hãy xem chúng tôi có gì !</i></p>
  <p class="text-c">GIAN HÀNG SẢN PHẨM VỀ CAFE</p>
  <hr style="width: 10%; height: 5px; background-color: rgb(108, 56, 39); border: none; margin: auto;" />

  <div class="container-store">
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c1.jpg" alt="Paper Pouch">
        <h3>CAFE PHA MÁY</h3>
        <div class="rating">★★★★☆</div>
        <div class="price">120.000đ</div>
    </div>
    <div class="product" style="position: relative;">
        <span class="sale-badge">SALE</span>
        <img src="<?php echo Base_URL?>public/images/c2.jpg" alt="Paper Bag">
        <h3>CAFE PHA PHIN</h3>
        <div class="rating">★★★★★</div>
        <div class="price"><span class="old-price">140.000đ</span> <span class="sale-price">125.000đ</span></div>
    </div>
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c3.jpg" alt="Plastic Pouch">
        <h3>CAFE GÓI</h3>
        <div class="rating">★★★★★</div>
        <div class="price">65.000đ</div>
    </div>
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c4.jpg" alt="Coffee Pot">
        <h3>LY SỨ</h3>
        <div class="rating">★★★★☆</div>
        <div class="price">70.000đ</div>
    </div>
  </div>

 
  
  <div class="container-store">
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c8.jpg" alt="Paper Pouch">
        <h3>CAFE HẠT NGUYÊN CHẤT</h3>
        <div class="rating">★★★★☆</div>
        <div class="price">118.000đ</div>
    </div>
    <div class="product" style="position: relative;">
        <span class="sale-badge">SALE</span>
        <img src="<?php echo Base_URL?>public/images/c5.jpg" alt="Paper Bag">
        <h3>ẤM TRÀ</h3>
        <div class="rating">★★★★☆</div>
        <div class="price"><span class="old-price">138.000đ</span> <span class="sale-price">123.000đ</span></div>
    </div>
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c6.jpg" alt="Plastic Pouch">
        <h3>COMBO</h3>
        <div class="rating">★★★★★</div>
        <div class="price">55.000đ</div>
    </div>
    <div class="product">
        <img src="<?php echo Base_URL?>public/images/c7.jpg" alt="Coffee Pot">
        <h3>LY GIẤY SIGNATURE</h3>
        <div class="rating">★★★★☆</div>
        <div class="price">25.000đ</div>
    </div>

</div>
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <footer class="footer-distributed">
      <div class="footer-left">
        <h3>Hippo<span>Coffee</span></h3>
        <p class="footer-links">
          <a href="#">Trang chủ</a> |
          <a href="#">Liên hệ</a> |
          <a href="#">Về chúng tôi</a> |
          <a href="#">Bài viết</a>
        </p>
        <p class="footer-company-name">Copyright 2024 <strong>HippoCoffee</strong>. All rights reserved.</p>
      </div>
    
      <div class="footer-center">
        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>Địa chỉ:</span>NGUYỄN HỮU THỌ, TÂN PHONG, Q7, TPHCM</p>
        </div>
        <div>
          <i class="fa fa-phone"></i>
          <p>+84 363747301</p>
        </div>
        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:contact@hippocoffee.com">contact@hippocoffee.com</a></p>
        </div>
      </div>
    
      <div class="footer-right">
        <p class="footer-company-about">
          <span>Về HippoCoffee - </span>
          HippoCoffee cam kết mang đến cho bạn những sản phẩm cà phê chất lượng nhất.
        </p>
        <div class="footer-icons">
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>

        </div>
      </div>
    </footer>
  </body>
</html>
