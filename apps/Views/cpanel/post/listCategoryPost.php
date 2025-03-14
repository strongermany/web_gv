<h3 style="text-align: center;">List Category Post</h3>
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
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($category as $key => $cate) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $cate['Title_category_post'] ?></td>
                <td><?php echo $cate['Content_category_post'] ?></td>
                <td><a href="<?php echo Base_URL ?>PostController/delete_category_post/<?php echo $cate['Id_category_post'] ?>">Delete</a>||
                    <a href="<?php echo Base_URL ?>PostController/edit_category_post/<?php echo $cate['Id_category_post'] ?>">Update</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>    
</table>