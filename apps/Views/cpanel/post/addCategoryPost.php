<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Add Category Post</h3>

<div class="col-md1-2">


    <form autocomplete="off" action="<?php echo Base_URL ?>PostController/insert_category_post" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title </label>
            <input type="text" name="Title" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <input type="text" name="Content" class="form-control">
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</div>