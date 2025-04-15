<section class="students">
        <h1>DANH SÁCH SINH VIÊN</h1>
        <ul>
            <?php if (!empty($std)) : ?>
                <?php foreach ($std as $student) : ?>
                    <li><?php echo htmlspecialchars($student['Name_std']); ?></li>
                <?php endforeach; ?>
            <?php else : ?>
                <li>Không có sinh viên nào.</li>
            <?php endif; ?>
        </ul>
    </section>