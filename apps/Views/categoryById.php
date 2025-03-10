<p>
    Category:
        <?php
        print_r($CategoryById);
    
        if (!empty($CategoryById) && is_array($CategoryById)) {
            foreach ($CategoryById as $key => $value) {
                echo "<li>" . htmlspecialchars($value['Category']) . "</li>";
            }
        } else {
            echo "No categories found!";
        }
    ?>
</p>
