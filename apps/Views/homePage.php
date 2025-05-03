



<!-- Technology News Section -->
<section class="news-section">
    <div class="news-header">
        <h1>TIN TỨC CÔNG NGHỆ MỚI NHẤT</h1>
    </div>

    <div class="news-row">
        <?php if (isset($data['newsItems']) && !empty($data['newsItems'])): ?>
            <?php 
            // Chỉ lấy 3 thông báo mới nhất
            $latestNews = array_slice($data['newsItems'], 0, 3);
            foreach ($latestNews as $news): 
            ?>
            <div class="news-col">
                <div class="news-badge">New</div>
                <?php if (!empty($news['image_url'])): ?>
                    <div class="news-image">
                        <img src="<?php echo Base_URL; ?>public/images/news/<?php echo $news['image_url']; ?>" 
                             alt="<?php echo $news['title']; ?>">
                    </div>
                <?php endif; ?>
                
                <div class="news-content">
                    <div class="content-left">
                        <h3><?php echo $news['title']; ?></h3>
                        <div class="news-text">
                            <p><?php echo substr($news['content'], 0, 100) . '...'; ?></p>
                        </div>
                        <div class="news-meta">
                            <span class="category"><?php echo $news['category']; ?></span>
                            <?php if(isset($news['created_at'])): ?>
                                <span class="date"><?php echo date('d/m/Y', strtotime($news['created_at'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="news-actions">
                        <a href="javascript:void(0)" class="like-btn">
                            <i class="fas fa-heart"></i>
                            Yêu thích
                        </a>
                        <a href="<?php echo $news['link_url']; ?>" class="like-btn details" target="_blank">
                            <i class="fas fa-arrow-right"></i>
                            Chi tiết
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="news-col">
                <p>Chưa có thông báo nào.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="courses-section">
    <div class="courses-header">
        <div class="header-content">
            <h1>Khóa học nổi bật</h1>
            <p>Khám phá các khóa học phổ biến nhất và bắt đầu học ngay hôm nay</p>
        </div>
        <div class="header-actions" style="flex-direction: row-reverse;">
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm khóa học...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="filter-options">
                <select>
                    <option value="">Tất cả lĩnh vực</option>
                    <option value="web">Lập trình Web</option>
                    <option value="mobile">Lập trình di động</option>
                    <option value="data">Khoa học dữ liệu</option>
                    <option value="design">Thiết kế</option>
                </select>
            </div>
        </div>
    </div>

    <div class="courses-container">
        <div class="courses-grid">
            <?php
            $itemsPerPage = 6;
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalCourses = count($data['courses']);
            $totalPages = ceil($totalCourses / $itemsPerPage);
            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $coursesOnPage = array_slice($data['courses'], $startIndex, $itemsPerPage);
            ?>
            <?php if (!empty($coursesOnPage)): ?>
                <?php foreach ($coursesOnPage as $course): ?>
                <div class="course-card">
                    <div class="course-image">
                        <img src="<?php echo Base_URL; ?>public/images/courses/<?php echo $course['image']; ?>" 
                             alt="<?php echo htmlspecialchars($course['title']); ?>">
                        <?php if ($course['discount'] > 0): ?>
                        <div class="discount-badge"><?php echo $course['discount']; ?>% OFF</div>
                        <?php endif; ?>
                    </div>
                    <div class="course-content">
                        <div class="course-info">
                            <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p class="course-instructor">
                                <i class="fas fa-user"></i>
                                <?php echo htmlspecialchars($course['instructor']); ?>
                            </p>
                        </div>
                        <div class="course-meta">
                            <div class="rating">
                                <div class="stars">
                                    <?php
                                    $rating = round($course['rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<i class="fas fa-star' . ($i <= $rating ? '' : '-o') . '"></i>';
                                    }
                                    ?>
                                </div>
                                <span class="rating-text">
                                    <?php echo number_format($course['rating'], 1); ?> 
                                    (<?php echo $course['rating_count']; ?> đánh giá)
                                </span>
                            </div>
                        </div>
                        <p class="course-description">
                            <?php echo htmlspecialchars(substr($course['description'], 0, 150)) . '...'; ?>
                        </p>
                        <div class="course-footer">
                            <div class="price-section">
                                <?php if ($course['discount'] > 0): ?>
                                <span class="original-price"><?php echo number_format($course['original_price'], 0); ?>đ</span>
                                <span class="discounted-price"><?php echo number_format($course['discounted_price'], 0); ?>đ</span>
                                <?php else: ?>
                                <span class="current-price"><?php echo number_format($course['original_price'], 0); ?>đ</span>
                                <?php endif; ?>
                            </div>
                            <div class="action-buttons">
                                <button class="btn-cart" title="Thêm vào giỏ hàng">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <button class="btn-buy">Mua Ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="no-courses">
                <i class="fas fa-book-open"></i>
                <p>Chưa có khóa học nào. Vui lòng thử lại sau.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?php echo ($currentPage - 1); ?>" class="pagination-prev">
                    <i class="fas fa-chevron-left"></i>
                </a>
            <?php else: ?>
                <span class="pagination-prev disabled">
                    <i class="fas fa-chevron-left"></i>
                </span>
            <?php endif; ?>

            <ul class="pagination-list">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="pagination-item">
                        <a href="?page=<?php echo $i; ?>" 
                           class="pagination-link <?php echo $i === $currentPage ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?php echo ($currentPage + 1); ?>" class="pagination-next">
                    <i class="fas fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <span class="pagination-next disabled">
                    <i class="fas fa-chevron-right"></i>
                </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Course Categories Section -->
<section class="categories-section">
    <div class="categories-header">
        <h2>Khám phá các lĩnh vực đào tạo</h2>
        <p>Lựa chọn từ nhiều khóa học thuộc các lĩnh vực khác nhau</p>
    </div>
    <div class="categories-grid">
        <div class="category-card">
            <i class="fas fa-code"></i>
            <h3>Lập trình Web</h3>
            <p>Thành thạo công nghệ web hiện đại</p>
        </div>
        <div class="category-card">
            <i class="fas fa-mobile-alt"></i>
            <h3>Lập trình di động</h3>
            <p>Xây dựng ứng dụng cho iOS và Android</p>
        </div>
        <div class="category-card">
            <i class="fas fa-database"></i>
            <h3>Khoa học dữ liệu</h3>
            <p>Phân tích và trực quan hóa dữ liệu</p>
        </div>
        <div class="category-card">
            <i class="fas fa-palette"></i>
            <h3>Thiết kế</h3>
            <p>Tạo giao diện người dùng đẹp mắt</p>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="features-header">
        <h2>Tại sao chọn nền tảng của chúng tôi</h2>
        <p>Khám phá những lợi ích khi học cùng chúng tôi</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Giảng viên chuyên gia</h3>
            <p>Học cùng các chuyên gia trong ngành với nhiều năm kinh nghiệm</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-clock"></i>
            <h3>Linh hoạt thời gian</h3>
            <p>Chủ động học tập mọi lúc, mọi nơi, theo tốc độ của bạn</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-certificate"></i>
            <h3>Chứng chỉ uy tín</h3>
            <p>Nhận chứng chỉ được công nhận sau khi hoàn thành</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-comments"></i>
            <h3>Hỗ trợ cộng đồng</h3>
            <p>Kết nối với học viên khác và nhận hỗ trợ khi cần thiết</p>
        </div>
    </div>
</section>

<!-- Call to Action Section -->


<script>
    // Smooth scroll for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Search functionality
    const searchInput = document.querySelector('.search-box input');
    searchInput.addEventListener('input', function(e) {
        // Add your search logic here
        console.log('Searching for:', e.target.value);
    });

    // Category filter
    const categorySelect = document.querySelector('.filter-options select');
    categorySelect.addEventListener('change', function(e) {
        // Add your filter logic here
        console.log('Selected category:', e.target.value);
    });

    // Pagination
    document.querySelectorAll('.pagination button').forEach(button => {
        button.addEventListener('click', function() {
            if (!this.disabled) {
                // Add your pagination logic here
                console.log('Clicked page:', this.textContent);
            }
        });
    });

    // Cart and Buy buttons
    document.querySelectorAll('.btn-cart').forEach(button => {
        button.addEventListener('click', function() {
            // Add your cart logic here
            console.log('Added to cart');
        });
    });

    document.querySelectorAll('.btn-buy').forEach(button => {
        button.addEventListener('click', function() {
            // Add your purchase logic here
            console.log('Initiated purchase');
        });
    });
</script>

<script>
  var navLinks = document.getElementById("navLinks");

  function showMenu() {
    navLinks.style.right = "0";
  }

  function hideMenu() {
    navLinks.style.right = "-200px";
  }
</script>

<script>
// Animation header xuất hiện khi scroll (liên tục)
const sectionHeaders = document.querySelectorAll('.news-header, .courses-header, .categories-header, .features-header');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        } else {
            entry.target.classList.remove('animate-in');
        }
    });
}, { threshold: 0.3 });
sectionHeaders.forEach(header => observer.observe(header));
</script>