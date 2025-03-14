<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Update category post </h3>

<div class="col-md-6">
    <?php
    foreach ($categoryById as $key => $cate) {

    ?>

        <form autocomplete="off" action="<?php echo Base_URL ?>PostController/update_category_post/<?php echo $cate['Id_category_post'] ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text"  value="<?php echo $cate['Title_category_post'] ?>"  name="Title" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="Content" style="resize: none;" row="5" class="form-control"><?php echo $cate['Content_category_post'] ?></textarea>
                
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php
    }
    ?>


</div>