<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_forward" />
<link rel="stylesheet" href="public/css/slider1.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body-a>
    <div class="container swiper">
        <div class="card-wrapper">
            <ul class="card-list swiper-wrapper">
                <?php if (!empty($sliderItems)): ?>
                <?php foreach ($sliderItems as $index => $item): ?>
                <li class="card-item swiper-slide">
                    <a href="<?php echo $item['link_url'] ?: '#'; ?>" class="card-link">
                        <img src="<?php echo Base_URL; ?>public/images/slider/<?php echo $item['image_url']; ?>"
                            class="card-image" alt="<?php echo $item['title']; ?>" />
                        <p class="badge">Developer</p>
                        <h2 class="card-title"><?php echo $item['title']; ?></h2>
                        <button class="card-button material-symbols-rounded">
                            arrow_forward
                        </button>
                    </a>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="no-slider">
                    <p>Chưa có dữ liệu slider</p>
                </div>
                <?php endif; ?>

            </ul>
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-slide-button swiper-button-prev"></div>
            <div class="swiper-slide-button swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="public/js/script.js"></script>
</body-a>