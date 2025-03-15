<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Add Blog</h3>

<div class="col-md1-2">


    <form autocomplete="off" action="<?php echo Base_URL ?>PostController/insert_post" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Product Name</label>
            <input type="text" name="title_post" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Image</label>
            <input type="file" name="image_post" class="form-control" aria-describedby="emailHelp">
        </div>
       
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content_post"  rows ="10" style="resize: none;" class="form-control"></textarea>
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Blog</label>
            <select class = "form-control"name="category_post" >
                <?php
                    foreach($category as $key=> $cate){

                    
                ?>
                <option value="<?php echo $cate['Id_category_post']?>"><?php echo $cate['Title_category_post']?></option>
                <?php
                    }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add blog</button>
    </form>



</div>