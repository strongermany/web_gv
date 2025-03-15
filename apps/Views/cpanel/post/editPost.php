<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Update Post</h3>

<div class="col-md1-2">
    <?php
    foreach ($postById as $key => $pos) {


    ?>

        <form autocomplete="off" action="<?php echo Base_URL ?>PostController/update_post/<?php echo $pos['Id_post']?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title Post</label>
                <input type="text" value="<?php echo $pos['Title_post'] ?>" name="title_post" class="form-control" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Image</label>
                <input type="file" name="image_post" class="form-control" aria-describedby="emailHelp">
                <p><img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $pos['Image_post'] ?>" height="100" width="100"></p>

            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content_post" rows="10" style="resize: none;" class="form-control"><?php echo $pos['Content_post'] ?></textarea>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category Blog</label>
                <select class="form-control" name="category_post">
                    <?php
                    foreach ($category as $key => $cate) {


                    ?>
                        <option value="<?php echo $cate['Id_category_post']; ?>" 
                        <?php if ($cate['Id_category_post'] == $pos['Id_category_post']) {
                                    echo 'selected';
                                } ?>value="<?php echo $cate['Id_category_post'] ?>"><?php echo $cate['Title_category_post'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">uUpdate blog</button>
        </form>

    <?php
    } ?>

</div>