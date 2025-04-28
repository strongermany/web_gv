<?php if (isset($data['sliderItems']) && !empty($data['sliderItems'])): ?>

<style>
.cnn-slider-list {
    display: flex;
    justify-content: center;
    align-items: center;
    transition: transform 1s cubic-bezier(.4,0,.2,1);
    will-change: transform;
    height: 100%;
}
</style>

<div class="cnn-slider-container">
    <div class="cnn-slider-list" id="cnnSliderList">
        <?php foreach ($data['sliderItems'] as $item): ?>
        <div class="cnn-slider-card">
            <img src="<?php echo Base_URL; ?>public/images/slider/<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>">
            <div class="cnn-slider-overlay">
                <div class="cnn-slider-title"><?php echo $item['title']; ?></div>
                <div class="cnn-slider-desc"><?php echo $item['content']; ?></div>
                <?php if (!empty($item['link_url'])): ?>
                <a href="<?php echo $item['link_url']; ?>" class="cnn-slider-link" target="_blank">Xem chi tiết</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="cnn-slider-nav">
        <button class="cnn-slider-btn" id="cnnSliderNext">&#8594;</button>
    </div>
    <div class="cnn-slider-dots" id="cnnSliderDots"></div>
</div>
<script>
(function() {
    const list = document.getElementById('cnnSliderList');
    const cards = list.querySelectorAll('.cnn-slider-card');
    const nextBtn = document.getElementById('cnnSliderNext');
    const dotsWrap = document.getElementById('cnnSliderDots');
    let current = 0;
    let visible = getVisibleCards();
    let isLooping = false;

    function getVisibleCards() {
        if (window.innerWidth <= 900) return 1;
        if (window.innerWidth <= 1200) return 2;
        return 3;
    }

    function updateSlider() {
        visible = getVisibleCards();
        const cardWidth = cards[0].offsetWidth + 32;
        list.style.transform = `translateX(-${current * cardWidth}px)`;
        dotsWrap.querySelectorAll('.cnn-slider-dot').forEach((dot, i) => {
            dot.classList.toggle('active', i === current);
        });
        cards.forEach((card, i) => {
            if (i === current) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }

    function goTo(idx) {
        visible = getVisibleCards();
        if (isLooping) return; // Ngăn chặn lặp nhiều lần
        if (idx >= cards.length) {
            isLooping = true;
            list.style.transition = "transform 1s cubic-bezier(.4,0,.2,1)";
            current = cards.length - 1;
            updateSlider();
            setTimeout(() => {
                list.style.transition = "none";
                current = 0;
                updateSlider();
                // Bật lại transition cho lần sau
                setTimeout(() => {
                    list.style.transition = "transform 1s cubic-bezier(.4,0,.2,1)";
                    isLooping = false;
                }, 50);
            }, 1000); // 1s đúng bằng thời gian transition
            return;
        }
        if (idx < 0) idx = 0;
        current = idx;
        updateSlider();
    }

    nextBtn.onclick = () => goTo(current + 1);
    // Dots
    dotsWrap.innerHTML = '';
    for (let i = 0; i < cards.length; i++) {
        const dot = document.createElement('button');
        dot.className = 'cnn-slider-dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => goTo(i);
        dotsWrap.appendChild(dot);
    }
    // Auto slide
    let auto = setInterval(() => goTo(current + 1), 5000);
    list.onmouseenter = () => clearInterval(auto);
    list.onmouseleave = () => auto = setInterval(() => goTo(current + 1), 5000);
    // Responsive update
    window.addEventListener('resize', () => {
        visible = getVisibleCards();
        dotsWrap.innerHTML = '';
        for (let i = 0; i < cards.length; i++) {
            const dot = document.createElement('button');
            dot.className = 'cnn-slider-dot' + (i === current ? ' active' : '');
            dot.onclick = () => goTo(i);
            dotsWrap.appendChild(dot);
        }
        updateSlider();
    });
    updateSlider();
})();
</script>
<?php endif; ?>