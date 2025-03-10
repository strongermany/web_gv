<p>
    Category:
    <?php
    
        if (!empty($Category) && is_array($Category)) {
            foreach ($Category as $key => $value) {
                echo "<li>" . htmlspecialchars($value['Category']) . "</li>";
            }
        } else {
            echo "No categories found!";
        }
    ?>
</p>
