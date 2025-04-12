<?php
    if (!empty($list) && is_array($list)) {
        echo '<div class="dropdown mb-4">';
        echo '<label for="classDropdown" class="form-label">Select a Class:</label>';
        echo '<select id="classDropdown" class="form-select">';
        foreach ($list as $key => $value) {
            $name = htmlspecialchars($value['Name_class']);
            $id = htmlspecialchars($value['Id_class']);
            echo '<option value="' . $id . '">' . $name . '</option>';
        }
        echo '</select>';
        echo '</div>';
    } else {
        echo '<p>No classes available.</p>';
    }
?>