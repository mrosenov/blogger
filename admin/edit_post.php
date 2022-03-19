<?php
edit_post();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Post</h3>
    </div>
    <?php
        if (isset($_GET['p_id'])){
            $PostID = $_GET['p_id'];
            $query = "SELECT * FROM posts WHERE postID = '$PostID'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)){
                $PostID = $row['postID'];
                $CategoryID = $row['catID'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_status = $row['post_status'];
            }
        }
    ?>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <select name="categoryID" class="form-control">
                    <?php
                    $PostID = $_GET['p_id'];
                    $query = "SELECT posts.postID,posts.catID,categories.catTitle FROM posts LEFT JOIN categories ON posts.catID = categories.catID WHERE postID = '$PostID'";
                    $result = mysqli_query($connection,$query);
                    while ($row = mysqli_fetch_assoc($result)){
                        $catID = $row['catID'];
                        $category_title = $row['catTitle'];
                        echo "<option value='$catID' selected>Current: $category_title</option>";
                    }
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection,$query);
                    while ($row = mysqli_fetch_assoc($result)){
                        $catID = $row['catID'];
                        $category_title = $row['catTitle'];
                        echo "<option value='$catID'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_title">Title</label>
                <input name="post_title" type="text" class="form-control" id="post_title" value="<?php echo $post_title;?>">
            </div>
            <div class="form-group">
                <label for="post_author">Author</label>
                <input name="post_author" type="text" class="form-control" id="post_author" value="<?php echo $post_author;?>">
            </div>
            <div class="form-group">
                <label for="post_content">Content</label>
                <textarea name="post_content" type="text" class="form-control" id="summernote" style="min-height: 250px;"><?php echo $post_content;?></textarea>
            </div>
            <div class="form-group">
                <label for="post_tags">Tags</label>
                <input name="post_tags" type="text" class="form-control" id="post_tags" value="<?php echo $post_tags;?>">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select name="post_status" class="form-control" id="post_status">
                    <option value="draft">Draft</option>
                    <option value="approved">Approved</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button name="edit_post" type="submit" class="btn btn-primary">Edit Post</button>
        </div>
    </form>
</div>