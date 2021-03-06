<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>

<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <?php
                        if (isset($_GET['cat'])){
                            $CategoryID = $_GET['cat'];
                            $query = "SELECT * FROM posts WHERE catID = '$CategoryID'";
                            $result = mysqli_query($connection,$query);

                            $count = mysqli_num_rows($result);
                            if ($count == 0){
                                echo "
                                <div class='alert alert-danger'>No posts in this category.</div>
                                ";
                            }
                            else{
                                while ($row = mysqli_fetch_assoc($result)){
                                    $postID = $row['postID'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_content = substr($row['post_content'],0,400);
                                    $post_tags = $row['post_tags'];
                                    $post_comments_count = $row['post_comments_count'];
                                    $post_status = $row['post_status'];
                                    $post_date = $row['created_at'];

                                    echo "
                                <div class='card' style='margin-top: 5px;'>
                                    <div class='card-header'>
                                        <a href='post.php?p_id=$postID'>$post_title</a>
                                    </div>
                                    <div class='card-body'>
                                        <p class='card-text'>$post_content</p>
                                    </div>
                                    <div class='card-footer text-muted'>
                                        Author: $post_author | Published: $post_date | Comments: $post_comments_count | <a href='post.php?p_id=$postID' class='btn btn-sm btn-dark'>Read More</a>
                                    </div>
                                </div>";
                                }
                            }

                        }

                    ?>

                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
