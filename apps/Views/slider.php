    <link rel="stylesheet" href="public/css/slider1.css" />
    <!-- <link rel="stylesheet" type="text/css" href="public/css/slider2.css" /> -->


<body>
    <div class="header-a">
        <div class="container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="../../Downloads/MHQH BTL-1.png" class="card-image" />
                            <p class="badge">Developer</p>
                            <h2 class="card-title">âdhuaodjaoidjadja</h2>
                            <button class="card-button material-symbols-rounded">
                                arrow_forward
                            </button>
                        </a>
                    </li>
                </ul>
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </header>

    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent">
                    <div class="container">
                        <div class="wgh-slider">
                            <?php if (!empty($sliderItems)): ?>
                                <?php foreach ($sliderItems as $index => $item): ?>
                                    <input class="wgh-slider-target" type="radio" id="slide-<?php echo $index + 1; ?>" name="slider" <?php echo $index == 0 ? 'checked="checked"' : ''; ?> />
                                <?php endforeach; ?>
                                
                                <div class="wgh-slider__viewport">
                                    <div class="wgh-slider__viewbox">
                                        <div class="wgh-slider__container">
                                            <?php foreach ($sliderItems as $index => $item): ?>
                                                <div class="wgh-slider-item">
                                                    <div class="wgh-slider-item__inner">
                                                        <figure class="wgh-slider-item-figure">
                                                            <img class="wgh-slider-item-figure__image" 
                                                                 src="<?php echo Base_URL; ?>public/images/slider/<?php echo $item['image_url']; ?>" 
                                                                 alt="<?php echo $item['title']; ?>" />
                                                            <figcaption class="wgh-slider-item-figure__caption">
                                                                <a href="<?php echo $item['link_url'] ?: '#'; ?>"><?php echo $item['title']; ?></a>
                                                                <span><?php echo $item['content']; ?></span>
                                                            </figcaption>
                                                        </figure>
                                                        <label class="wgh-slider-item__trigger" for="slide-<?php echo $index + 1; ?>" title="Show item <?php echo $index + 1; ?>"></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="no-slider">
                                    <p>Chưa có dữ liệu slider</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    let currentSlide = 1;
    const totalSlides = <?php echo count($sliderItems); ?>;

    function nextSlide() {
        currentSlide = (currentSlide % totalSlides) + 1;
        document.getElementById(`slide-${currentSlide}`).checked = true;
    }

    // Start the automatic slider
    setInterval(nextSlide, 5000);
</script>

<style>
.no-slider {
    text-align: center;
    padding: 50px;
    background: #f8f9fa;
    border-radius: 10px;
    margin: 20px 0;
}

.no-slider p {
    color: #666;
    font-size: 18px;
}
</style>