<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>

<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class='card' style='margin-top: 5px;'>
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
                                    $post_comments_count = $row['post_comments_count'];
                                    $post_status = $row['post_status'];
                                    $post_date = $row['created_at'];
                                }
                            }
                        ?>
                        <div class='card-header'>
                            <?php echo $post_title; ?>
                        </div>
                        <div class='card-body'>
                            <p class='card-text'><?php echo $post_content; ?></p>
                        </div>
                        <div class='card-footer text-muted'>
                            Author: <?php echo $post_author; ?> | Published: <?php echo $post_date; ?>
                        </div>
                    </div>
                    <?php create_comment(); ?>
                    <section class="mb-5" style="margin-top: 5px;">
                        <div class="card bg-light">
                            <div class="card-body">
                                <p>Leave a comment</p>
                                <form action="" method="post" class="mb-4">
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <input name="comment_author" type="text" class="form-control" placeholder="Author">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <input name="comment_email" type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="comment_content" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" style="max-height: 150px;"></textarea>
                                    </div>
                                    <div class="form-group d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button name="create_comment" type="submit" class="btn btn-sm btn-info md-2" style="margin-top: 10px;">Post Comment</button>
                                    </div>

                                </form>
                                <!--<div class="d-flex mb-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..."></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Single comment-->
                                <?php
                                    $query = "SELECT * FROM comments WHERE post_ID = '$PostID' AND comment_status = 'Approved' ORDER BY comment_date DESC";
                                    $result =  mysqli_query($connection, $query);

                                    $count = mysqli_num_rows($result);
                                    if ($count == 0){
                                        echo "
                                         <div class='alert alert-danger' role='alert'>
                                          No comments yet.
                                        </div>";
                                    }
                                    else{
                                        while ($row = mysqli_fetch_assoc($result)){
                                            $comment_author = $row['comment_author'];
                                            $comment_content = $row['comment_content'];
                                            $comment_date = $row['comment_date'];

                                            echo "
                                        <div class='d-flex' style='margin-bottom: 5px;'>
                                            <div class='flex-shrink-0'>
                                                <img class='rounded-circle' src='https://dummyimage.com/50x50/ced4da/6c757d.jpg' alt='...'>
                                            </div>
                                            <div class='ms-3'>
                                                <div class='fw-bold'>$comment_author</div><div class='text-muted'>$comment_date</div>
                                                $comment_content
                                            </div>
                                        </div>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
