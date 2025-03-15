<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Update product</h3>

<div class="col-md1-2">
    <?php
    foreach ($productById as $key => $pro)
    ?>


    <form autocomplete="off" action="<?php echo Base_URL ?>ProductController/update_product/<?php echo $pro['Id_product'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Product Name</label>
            <input type="text" value=" <?php echo $pro['Title_product'] ?>" name="title_product" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" aria-describedby="emailHelp">
            <p><img src="<?php echo Base_URL ?>public/uploads/product/<?php echo $pro['Images_product'] ?>" height="100" width="100"></p>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Price</label>
            <input type="text" value=" <?php echo $pro['Price_product'] ?>" name="price" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Quantity</label>
            <input type="text" value=" <?php echo $pro['Quantity_product'] ?>"  name="quantity" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="desc_product" rows="5" style="resize: none;" class="form-control"> <?php echo $pro['Desc_product'] ?></textarea>

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Product Category</label>
            <select class="form-control" name="product_category">
                <?php
                foreach ($category as $key => $cate) {
                ?>
                    <option <?php if ($pro['Id_category_product'] == $cate['Id_Cate']) {
                                echo 'selected';
                            } ?> value="<?php echo $cate['Id_Cate']; ?>">
                        <?php echo $cate['Category']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">update</button>
    </form>



</div>