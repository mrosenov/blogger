<?php
create_post();
?>
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Post</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <select name="categoryID" class="form-control">
                        <option value="" disabled selected>Select Category</option>
                        <?php
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
                    <input name="post_title" type="text" class="form-control" id="post_title" placeholder="Post Title">
                </div>
                <div class="form-group">
                    <label for="post_author">Author</label>
                    <input name="post_author" type="text" class="form-control" id="post_author" placeholder="Author">
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea name="post_content" type="text" class="form-control" id="post_content" placeholder="Content" style="min-height: 250px;"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_tags">Tags</label>
                    <input name="post_tags" type="text" class="form-control" id="post_tags" placeholder="Tags">
                </div>
                <div class="form-group">
                    <select name="post_status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="approved">Approved</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_date">Date</label>
                    <input name="post_date" type="datetime-local" class="form-control" id="post_date" placeholder="Date">
                </div>
            </div>
            <div class="card-footer">
                <button name="create_post" type="submit" class="btn btn-primary">Add Post</button>
            </div>
        </form>
 </div>