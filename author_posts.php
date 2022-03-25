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
                            if (isset($_GET['au'])){
                                //$PostID = $_GET['p_id'];
                                $Author = $_GET['au'];
                                $query = "SELECT * FROM posts WHERE post_author = '$Author'";
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

                                    echo "
                                        <div class='card-header'>
                                            $post_title
                                        </div>
                                        <div class='card-body'>
                                            <p class='card-text'>$post_content</p>
                                        </div>
                                        <div class='card-footer text-muted'>
                                            Author: $post_author | Published: $post_date
                                        </div>";
                                }
                            }
                        ?>

                    </div>

                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
