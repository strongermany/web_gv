<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CSS 3D Coverflow Image Slider</title>
    <meta name="author" content="Codeconvey" />
    <link rel="stylesheet" href="public/css/slider1.css" />
    <link rel="stylesheet" type="text/css" href="public/css/slider2.css" />
</head>

<body>
    <header class="ScriptHeader">
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="rt-heading">
                    <h1>BẢNG THÀNH TÍCH</h1>
                    <p>Giảng viên: Lê Văn A - Master of Data Science</p>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent">
                    <div class="container">
                        <div class="wgh-slider">
                            <input class="wgh-slider-target" type="radio" id="slide-1" name="slider" />
                            <input class="wgh-slider-target" type="radio" id="slide-2" name="slider" />
                            <input class="wgh-slider-target" type="radio" id="slide-3" name="slider"
                                checked="checked" />
                            <input class="wgh-slider-target" type="radio" id="slide-4" name="slider" />
                            <input class="wgh-slider-target" type="radio" id="slide-5" name="slider" />
                            <div class="wgh-slider__viewport">
                                <div class="wgh-slider__viewbox">
                                    <div class="wgh-slider__container">
                                        <div class="wgh-slider-item">
                                            <div class="wgh-slider-item__inner">
                                                <figure class="wgh-slider-item-figure">
                                                    <img class="wgh-slider-item-figure__image" src="img/image-1.jpg"
                                                        alt="The 5th Exotic" />
                                                    <figcaption class="wgh-slider-item-figure__caption">
                                                        <a href="https://f4.bcbits.com/img/a3905613628_16.jpg">Cử nhân
                                                            Khoa Học Máy Tính</a><span>ĐH TDT - 2015 </span>
                                                    </figcaption>
                                                </figure>
                                                <label class="wgh-slider-item__trigger" for="slide-1"
                                                    title="Show product 1"></label>
                                            </div>
                                        </div>
                                        <div class="wgh-slider-item">
                                            <div class="wgh-slider-item__inner">
                                                <figure class="wgh-slider-item-figure">
                                                    <img class="wgh-slider-item-figure__image" src="img/image-2.jpg"
                                                        alt="The 5th Exotic" />
                                                    <figcaption class="wgh-slider-item-figure__caption">
                                                        <a href="https://f4.bcbits.com/img/a3905613628_16.jpg">Thạc sỹ
                                                            Khoa Học Dữ Liệu</a><span>Mongolia University - 2018</span>
                                                    </figcaption>
                                                </figure>
                                                <label class="wgh-slider-item__trigger" for="slide-2"
                                                    title="Show product 2"></label>
                                            </div>
                                        </div>
                                        <div class="wgh-slider-item">
                                            <div class="wgh-slider-item__inner">
                                                <figure class="wgh-slider-item-figure">
                                                    <img class="wgh-slider-item-figure__image" src="img/image-3.png"
                                                        alt="The 5th Exotic" />
                                                    <figcaption class="wgh-slider-item-figure__caption">
                                                        <a href="https://f4.bcbits.com/img/a3905613628_16.jpg">Tiến sỹ
                                                            Khoa Học Dữ Liệu</a><span>Montelipoer University</span>
                                                    </figcaption>
                                                </figure>
                                                <label class="wgh-slider-item__trigger" for="slide-3"
                                                    title="Show product 3"></label>
                                            </div>
                                        </div>
                                        <div class="wgh-slider-item">
                                            <div class="wgh-slider-item__inner">
                                                <figure class="wgh-slider-item-figure">
                                                    <img class="wgh-slider-item-figure__image" src="img/image-4.jpg"
                                                        alt="The 5th Exotic" />
                                                    <figcaption class="wgh-slider-item-figure__caption">
                                                        <a href="https://f4.bcbits.com/img/a3905613628_16.jpg">Bài báo
                                                            khoa học</a><span>2015</span>
                                                    </figcaption>
                                                </figure>
                                                <label class="wgh-slider-item__trigger" for="slide-4"
                                                    title="Show product 4"></label>
                                            </div>
                                        </div>
                                        <div class="wgh-slider-item">
                                            <div class="wgh-slider-item__inner">
                                                <figure class="wgh-slider-item-figure">
                                                    <img class="wgh-slider-item-figure__image" src="img/th.jpg"
                                                        alt="RYSY - Traveler LP" />
                                                    <figcaption class="wgh-slider-item-figure__caption">
                                                        <a href="https://picsum.photos/id/237/480/480">Dự án công
                                                            nghệ</a><span>2020</span>
                                                    </figcaption>
                                                </figure>
                                                <label class="wgh-slider-item__trigger" for="slide-5"
                                                    title="Show product 5"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- partial -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>