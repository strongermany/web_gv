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
.cnn-slider-list.single-slide {
    justify-content: center !important;
    transform: none !important;
}
</style>

<div class="cnn-slider-container">
    <div class="cnn-slider-list" id="cnnSliderList">
        <?php foreach ($data['sliderItems'] as $item): ?>
        <div class="cnn-slider-card">
            <img src="<?php echo Base_URL; ?>public/images/slider/<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>">
            <div class="cnn-slider-overlay">
                <div class="cnn-slider-title"><?php echo $item['title']; ?></div>
                <div class="cnn-slider-desc"><?php 
                    $words = explode(' ', $item['content']);
                    $short = implode(' ', array_slice($words, 0, 8));
                    echo $short . (count($words) > 8 ? '...' : '');
                ?></div>
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

    function getVisibleCards() {
        if (window.innerWidth <= 900) return 1;
        if (window.innerWidth <= 1200) return 2;
        return 3;
    }

    function updateSlider() {
        visible = getVisibleCards();
        if (current > cards.length - visible) current = cards.length - visible;
        if (current < 0) current = 0;
        const cardWidth = cards[0].offsetWidth + 32;
        list.style.transform = `translateX(-${current * cardWidth}px)`;
        dotsWrap.querySelectorAll('.cnn-slider-dot').forEach((dot, i) => {
            dot.classList.toggle('active', i === current);
        });
        if (cards.length <= visible) {
            nextBtn.style.display = 'none';
            dotsWrap.style.display = 'none';
            list.classList.add('single-slide');
            list.style.transform = 'none';
        } else {
            nextBtn.style.display = '';
            dotsWrap.style.display = '';
            list.classList.remove('single-slide');
        }
    }

    function goTo(idx) {
        visible = getVisibleCards();
        if (idx > cards.length - visible) idx = 0;
        if (idx < 0) idx = 0;
        current = idx;
        updateSlider();
    }

    nextBtn.onclick = () => goTo(current + 1);

    function renderDots() {
        dotsWrap.innerHTML = '';
        let dotCount = cards.length - visible + 1;
        if (dotCount < 1) dotCount = 1;
        for (let i = 0; i < dotCount; i++) {
            const dot = document.createElement('button');
            dot.className = 'cnn-slider-dot' + (i === current ? ' active' : '');
            dot.onclick = () => goTo(i);
            dotsWrap.appendChild(dot);
        }
    }

    let auto = setInterval(() => goTo(current + 1), 5000);
    list.onmouseenter = () => clearInterval(auto);
    list.onmouseleave = () => auto = setInterval(() => goTo(current + 1), 5000);

    window.addEventListener('resize', () => {
        visible = getVisibleCards();
        renderDots();
        updateSlider();
    });

    renderDots();
    updateSlider();
})();
</script>
<?php endif; ?>