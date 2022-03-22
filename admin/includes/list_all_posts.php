<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all posts</h3>
    </div>
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <?php Bulk_Option_Posts(); ?>
            <div class="row">
                <form action="" method="post">
                <div class="btn-group w-100">
                <div class="col-sm-2">
                    <div class="form-group">
                        <select class="form-control" name="bulk_options">
                            <option value="">Select Options</option>
                            <option value="approved">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input name="apply_bulk" type="submit" class="btn btn-success" value="Apply">
                    </div>
                </div>
                </div>
                <div class="col-sm-12">
                    <?php delete_post(); ?>
                    <table class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th class="sorting"><input type="checkbox" id="SelectAll"></th>
                            <th class="sorting">Post ID</th>
                            <th class="sorting">Category</th>
                            <th class="sorting">Title</th>
                            <th class="sorting">Author</th>
                            <th class="sorting">Tags</th>
                            <th class="sorting">Comments</th>
                            <th class="sorting">Status</th>
                            <th class="sorting">Published</th>
                            <th class="sorting">Created At</th>
                            <th class="sorting">Last Updated</th>
                            <th class="sorting">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM posts LEFT JOIN categories ON posts.catID = categories.catID";
                            $result = mysqli_query($connection,$query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $postID = $row['postID'];
                                $category_title = $row['catTitle'];
                                $catID = $row['catID'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_tags = $row['post_tags'];
                                $post_comments = $row['post_comments_count'];
                                $post_status = $row['post_status'];
                                $post_date = $row['post_date'];
                                $created_at = $row['created_at'];
                                $updated_at = $row['updated_at'];

                                echo "
                                <tr class='odd'>
                                    <td><input type='checkbox' class='CheckBox' name='CheckBoxArray[]' value='$postID'></td>
                                    <td>$postID</td>
                                    <td>$category_title</td>
                                    <td>$post_title</td>
                                    <td>$post_author</td>
                                    <td>$post_tags</td>
                                    <td>$post_comments</td>
                                    <td>$post_status</td>
                                    <td>$post_date</td>
                                    <td>$created_at</td>
                                    <td>$updated_at</td>
                                    <td><a href='posts.php?delete=$postID' class='btn btn-danger'>Delete</a> <a href='posts.php?source=edit_post&p_id=$postID' class='btn btn-warning'>Edit</a> <a href='../post.php?p_id=$postID' class='btn btn-primary'>View</a></td>
                                </tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
