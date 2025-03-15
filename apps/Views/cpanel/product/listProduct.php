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
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Description</th>
            <th scope="col">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($product as $key => $pro) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $pro['Title_product'] ?></td>
                <td><img src="<?php echo Base_URL?>public/uploads/product/<?php echo $pro['Images_product'] ?>" height="100" width="100"></td>
                <td><?php echo $pro['Category'] ?></td>
                <td><?php echo number_format($pro['Price_product'],0,',','.').'$'?></td>
                <td><?php echo $pro['Quantity_product'] ?></td>
                <td><?php echo $pro['Desc_product'] ?></td>
                <td><a href="<?php echo Base_URL ?>ProductController/delete_product/<?php echo $pro['Id_product'] ?>">Delete</a>||
                    <a href="<?php echo Base_URL ?>ProductController/edit_product/<?php echo $pro['Id_product'] ?>">Update</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>    
</table>