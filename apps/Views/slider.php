    <link rel="stylesheet" href="public/css/slider1.css" />
    <!-- <link rel="stylesheet" type="text/css" href="public/css/slider2.css" /> -->




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