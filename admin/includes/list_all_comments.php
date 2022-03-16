<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all comments</h3>
    </div>
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                        delete_comment();
                        approve_comment();
                        unapprove_comment();
                    ?>
                    <table class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th class="sorting">Comment ID</th>
                            <th class="sorting">Posted In</th>
                            <th class="sorting">Author</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Content</th>
                            <th class="sorting">Status</th>
                            <th class="sorting">Published</th>
                            <th class="sorting">Created at</th>
                            <th class="sorting">Last Updated</th>
                            <th class="sorting">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM comments LEFT JOIN posts ON comments.post_ID = posts.PostID";
                            $result = mysqli_query($connection,$query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $commentID = $row['comment_ID'];
                                $postID = $row['post_ID'];
                                $post_title = $row['post_title'];
                                $comment_author = $row['comment_author'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                                $created_at = $row['created_at'];
                                $updated_at = $row['updated_at'];


                                echo "
                                <tr class='odd'>
                                    <td>$commentID</td>
                                    <td><a href='../post.php?p_id=$postID'>$post_title</a></td>
                                    <td>$comment_author</td>
                                    <td>$comment_email</td>
                                    <td>$comment_content</td>
                                    <td>$comment_status</td>
                                    <td>$comment_date</td>
                                    <td>$created_at</td>
                                    <td>$updated_at</td>
                                    <td><a href='comments.php?delete=$commentID' class='btn btn-danger'>Delete</a> <a href='comments.php?approve=$commentID&p_id=$postID' class='btn btn-success'>Approve</a> <a href='comments.php?unapprove=$commentID&p_id=$postID' class='btn btn-warning'>Unapprove</a></td>
                                </tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
