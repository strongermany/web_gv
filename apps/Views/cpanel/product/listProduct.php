<h3 style="text-align: center;">Update Category</h3>
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
            <th scope="col">Description</th>
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
                <td><?php echo $cate['Category'] ?></td>
                <td><?php echo $cate['Descript_Cate'] ?></td>
                <td><a href="<?php echo Base_URL ?>ProductController/delete_category/<?php echo $cate['Id_Cate'] ?>">Delete</a>||
                    <a href="<?php echo Base_URL ?>ProductController/edit_category/<?php echo $cate['Id_Cate'] ?>">Update</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>    
</table>