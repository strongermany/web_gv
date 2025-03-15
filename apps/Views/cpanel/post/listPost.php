<h3 style="text-align: center;">List Category Product</h3>
<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>
<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($post as $key => $pos) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $pos['Title_post'] ?></td>
                <td><img src="<?php echo Base_URL?>public/uploads/post/<?php echo $pos['Image_post'] ?>" height="100" width="100"></td>
                <td><?php echo $pos['Title_category_post'] ?></td>
                
                <td><a href="<?php echo Base_URL ?>PostController/delete_post/<?php echo $pos['Id_post'] ?>">Delete</a>||
                    <a href="<?php echo Base_URL ?>PostController/edit_post/<?php echo $pos['Id_post'] ?>">Update</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>    
</table>