-- Thêm dữ liệu mẫu cho bảng khóa học
INSERT INTO courses (title, instructor, description, image, original_price, discount, discounted_price, rating, rating_count) VALUES
('Complete Web Development Bootcamp 2024', 'Dr. Angela Yu', 'Trở thành một Web Developer chuyên nghiệp với HTML, CSS, Javascript, React, Node.js, MongoDB và nhiều công nghệ hiện đại khác.', 'web-dev-bootcamp.jpg', 1990000, 15, 1691500, 4.8, 150),

('Master Python Programming: From Basics to Advanced', 'Jose Portilla', 'Học Python từ cơ bản đến nâng cao, bao gồm OOP, Data Structures, Algorithms và Machine Learning cơ bản.', 'python-master.jpg', 1590000, 20, 1272000, 4.7, 120),

('Full Stack Java Development', 'Chad Darby', 'Khóa học toàn diện về phát triển ứng dụng với Java, Spring Boot, Hibernate và Angular.', 'java-fullstack.jpg', 2190000, 10, 1971000, 4.9, 200),

('Mobile App Development with Flutter', 'Max Schwarzmüller', 'Xây dựng ứng dụng di động đa nền tảng với Flutter và Dart. Từ cơ bản đến xuất bản ứng dụng.', 'flutter-dev.jpg', 1790000, 25, 1342500, 4.6, 90),

('Data Science and Machine Learning Bootcamp', 'Kirill Eremenko', 'Làm chủ Data Science, Machine Learning và Deep Learning với Python, TensorFlow và scikit-learn.', 'data-science.jpg', 2490000, 30, 1743000, 4.8, 180),

('Modern UI/UX Design with Figma', 'Daniel Walter Scott', 'Học thiết kế giao diện người dùng hiện đại với Figma. Từ wireframe đến prototype hoàn chỉnh.', 'ui-ux-design.jpg', 1490000, 15, 1266500, 4.7, 110),

('Advanced JavaScript and React Development', 'Stephen Grider', 'Làm chủ JavaScript hiện đại và React.js. Xây dựng ứng dụng web phức tạp với Redux và GraphQL.', 'react-advanced.jpg', 1890000, 20, 1512000, 4.9, 160),

('DevOps Engineering and Cloud Computing', 'Stephane Maarek', 'Học DevOps với Docker, Kubernetes, CI/CD và AWS Cloud. Từ cơ bản đến triển khai thực tế.', 'devops-cloud.jpg', 2290000, 10, 2061000, 4.8, 140),

('Cyber Security: From Beginner to Expert', 'Nathan House', 'Làm chủ bảo mật mạng và ứng dụng. Học penetration testing, cryptography và security best practices.', 'cyber-security.jpg', 1990000, 25, 1492500, 4.6, 95),

('Blockchain Development with Ethereum', 'Filip Jerga', 'Phát triển ứng dụng blockchain với Ethereum, Solidity và Web3.js. Xây dựng DApps và Smart Contracts.', 'blockchain-dev.jpg', 2190000, 15, 1861500, 4.7, 85);

-- Thêm dữ liệu cho các khóa học tiếng Việt
INSERT INTO courses (title, instructor, description, image, original_price, discount, discounted_price, rating, rating_count) VALUES
('Lập Trình Web PHP & MySQL Từ Zero đến Hero', 'Trần Văn Minh', 'Khóa học toàn diện về lập trình web với PHP & MySQL. Xây dựng website động từ A-Z với các công nghệ hiện đại.', 'php-mysql.jpg', 1490000, 20, 1192000, 4.8, 120),

('Làm Chủ JavaScript và ReactJS', 'Nguyễn Đức Hoàng', 'Học JavaScript và ReactJS từ cơ bản đến nâng cao. Xây dựng các ứng dụng web single-page hiện đại.', 'js-react.jpg', 1790000, 15, 1521500, 4.7, 95),

('Khóa Học Python cho AI và Data Science', 'Phạm Thị Mai', 'Học Python chuyên sâu cho AI và Data Science. Thực hành với các dự án thực tế về Machine Learning và Deep Learning.', 'python-ai.jpg', 2190000, 25, 1642500, 4.9, 150),

('Thiết Kế UI/UX Professional', 'Lê Quang Đạo', 'Khóa học chuyên sâu về thiết kế UI/UX. Làm việc với các công cụ thiết kế hiện đại và quy trình làm việc chuyên nghiệp.', 'uiux-pro.jpg', 1590000, 30, 1113000, 4.6, 80),

('Lập Trình Mobile App với Flutter', 'Đỗ Minh Quân', 'Phát triển ứng dụng di động đa nền tảng với Flutter. Từ cơ bản đến xuất bản ứng dụng lên App Store và Google Play.', 'flutter-mobile.jpg', 1890000, 20, 1512000, 4.8, 110); 