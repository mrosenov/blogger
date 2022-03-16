<?php

function list_posts(){
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'Approved'";
    $result = mysqli_query($connection,$query);

    $count = mysqli_num_rows($result);
    if($count == 0){
        echo "
                                <div class='alert alert-danger' role='alert'>
                                  There are no categories
                                </div>";
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

function create_post(){
    global $connection;
    if (isset($_POST['create_post'])){
        $categoryID = mysqli_real_escape_string($connection,$_POST['categoryID']);
        $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
        $post_author = mysqli_real_escape_string($connection,$_POST['post_author']);
        $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
        $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
        $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);
        $post_date = mysqli_real_escape_string($connection,$_POST['post_date']);
        $created_at = date("Y-m-d h:i:sa");
        $updated_at = date("Y-m-d h:i:sa");



        if ($categoryID == "" || empty($categoryID)){
            echo "<script type='text/javascript'>toastr.error('Select Category.')</script>";
        }
        elseif ($post_title == "" || empty($post_title)){
            echo "<script type='text/javascript'>toastr.error('Please add title.')</script>";
        }
        elseif ($post_author == "" || empty($post_author)){
            echo "<script type='text/javascript'>toastr.error('Please add author.')</script>";
        }
        elseif ($post_content == "" || empty($post_content)){
            echo "<script type='text/javascript'>toastr.error('Please add content.')</script>";
        }
        elseif ($post_tags == "" || empty($post_tags)){
            echo "<script type='text/javascript'>toastr.error('Please add tags.')</script>";
        }
        elseif ($post_status == "" || empty($post_status)){
            echo "<script type='text/javascript'>toastr.error('Please add status.')</script>";
        }
        elseif ($post_date == "" || empty($post_date)){
            echo "<script type='text/javascript'>toastr.error('Please add date.')</script>";
        }
        else {
            $query = "INSERT INTO posts (catID,post_title,post_author,post_content,post_tags,post_status,post_date,created_at,updated_at) VALUES ('$categoryID','$post_title','$post_author','$post_content','$post_tags','$post_status','$post_date','$created_at','$updated_at')";
            $result = mysqli_query($connection,$query);

            if ($result){
                echo "<script type='text/javascript'>toastr.success('Post added successfully.')</script>";
            }
            else{
                echo "<script type='text/javascript'>toastr.error('Could not add the post.')</script>";
            }

        }
    }
}

function edit_post(){
    global $connection;
    if (isset($_POST['edit_post'])){
        $categoryID = mysqli_real_escape_string($connection,$_POST['categoryID']);
        $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
        $post_author = mysqli_real_escape_string($connection,$_POST['post_author']);
        $post_content = mysqli_real_escape_string($connection,$_POST['post_content']);
        $post_tags = mysqli_real_escape_string($connection,$_POST['post_tags']);
        $post_status = mysqli_real_escape_string($connection,$_POST['post_status']);
        $updated_at = date("Y-m-d h:i:sa");

        if ($categoryID == "" || empty($categoryID)){
            echo "<script type='text/javascript'>toastr.error('Select Category.')</script>";
        }
        elseif ($post_title == "" || empty($post_title)){
            echo "<script type='text/javascript'>toastr.error('Please add title.')</script>";
        }
        elseif ($post_author == "" || empty($post_author)){
            echo "<script type='text/javascript'>toastr.error('Please add author.')</script>";
        }
        elseif ($post_content == "" || empty($post_content)){
            echo "<script type='text/javascript'>toastr.error('Please add content.')</script>";
        }
        elseif ($post_tags == "" || empty($post_tags)){
            echo "<script type='text/javascript'>toastr.error('Please add tags.')</script>";
        }
        elseif ($post_status == "" || empty($post_status)){
            echo "<script type='text/javascript'>toastr.error('Please add status.')</script>";
        }
        else {
            $PostID = $_GET['p_id'];
            $query = "UPDATE posts SET catID = '$categoryID',post_title = '$post_title',post_author = '$post_author',post_content = '$post_content',post_tags = '$post_tags',post_status = '$post_status',updated_at = '$updated_at' WHERE postID = '$PostID'";

            $result = mysqli_query($connection,$query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Post updated successfully.')</script>";
            }
            else {
                echo "<script type='text/javascript'>toastr.error('Could not update the post.')</script>";
            }
        }


    }
}

function delete_post() {
    global $connection;
    if (isset($_GET['delete'])){
        $postID = $_GET['delete'];
        $query = "DELETE FROM posts WHERE postID = $postID";
        $result = mysqli_query($connection, $query);
        if ($result){
            echo "<script type='text/javascript'>toastr.success('Post deleted successfully.')</script>";
        }
        else {
            echo"<script type='text/javascript'>toastr.error('Could not delete the post.')</script>";
        }
    }
}

function create_category() {
    global $connection;
    if (isset($_POST['CreateCategory'])){
        $cat_title = mysqli_real_escape_string($connection,$_POST['cat_title']);
        if ($cat_title == "" || empty($cat_title)){
            echo "<script type='text/javascript'>toastr.error('Category title must be filled.')</script>";
        }
        else {
            $query = "INSERT INTO categories (catTitle) VALUES ('$cat_title')";
            $result = mysqli_query($connection,$query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Category added successfully.')</script>";
            }
            else {
                echo "<script type='text/javascript'>toastr.error('Could not add the category.')</script>";
            }
        }
    }
}

function edit_category() {
    global $connection;
    if (isset($_GET['edit'])) {
        $catID = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE catID = $catID";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $cat_title = $row['catTitle'];
        }
        echo '
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input name="cat_title" value="'.$cat_title.'" type="text" class="form-control" placeholder="'.$cat_title.'">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button id="myBtn" name="EditCategory" type="submit" class="btn btn-primary">Edit Category</button>
                                </div>
                            </form>
                        </div>       
        ';
        if (isset($_POST['EditCategory'])) {
            $cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
            if ($cat_title == "" || empty($cat_title)) {
                echo "<script type='text/javascript'>toastr.error('Category title must be filled.')</script>";
            } else {
                $query = "UPDATE categories SET catTitle = '$cat_title' WHERE catID = $catID";
                $result = mysqli_query($connection, $query);
                if ($result){
                    echo "<script type='text/javascript'>toastr.success('Category updated successfully.')</script>";
                }
                else{
                    echo "<script type='text/javascript'>toastr.error('Could not edit the category')</script>";
                }
            }
        }
    }
}

function delete_category() {
    global $connection;
    if (isset($_GET['delete'])){
        $catID = $_GET['delete'];
        $query = "DELETE FROM categories WHERE catID = $catID";
        $result = mysqli_query($connection,$query);
        if ($result){
            echo "<script type='text/javascript'>toastr.success('Category deleted successfully.')</script>";
        }
        else {
            echo"<script type='text/javascript'>toastr.error('Couldnt delete the category.')</script>";
        }
    }
}

function list_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);

    if (mysqli_num_rows($result) === 0 ){
        echo "
        <div class='alert alert-danger' role='alert'>
          There are no categories
        </div>";
    }
    else {
        while ($row = mysqli_fetch_assoc($result)){
            $catID = $row['catID'];
            $cat_title = $row['catTitle'];
            echo "
                                    <tr>
                                        <td>$catID</td>
                                        <td>$cat_title</td>
                                        <td><a href='categories.php?edit=$catID' onclick='ShowEditForm()''>Edit</a> | <a href='categories.php?delete=$catID'>Delete</a></td>
                                    </tr> ";
        }
    }
}

function create_comment(){
    global $connection;
    if (isset($_POST['create_comment'])){
        $PostID = $_GET['p_id'];
        $comment_author = mysqli_real_escape_string($connection,$_POST['comment_author']);
        $comment_email = mysqli_real_escape_string($connection,$_POST['comment_email']);
        $comment_content = mysqli_real_escape_string($connection,$_POST['comment_content']);
        $comment_date = date("Y-m-d h:i:sa");


        if ($comment_author == "" || empty($comment_author)){
            echo "<script type='text/javascript'>toastr.error('Please add author to the comment.')</script>";
        }
        elseif ($comment_email == "" || empty($comment_email)){
            echo "<script type='text/javascript'>toastr.error('Please add email to the comment.')</script>";
        }
        elseif ($comment_content == "" || empty($comment_content)){
            echo "<script type='text/javascript'>toastr.error('Please add some content to the comment.')</script>";
        }
        else{
            $query = "INSERT INTO comments (post_ID,comment_author,comment_email,comment_content,comment_status,comment_date,created_at,updated_at) VALUES ('$PostID', '$comment_author', '$comment_email','$comment_content','Unpproved','$comment_date','$comment_date','$comment_date')";
            $result = mysqli_query($connection, $query);
            $count_query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE postID = '$PostID'";
            $update_count = mysqli_query($connection, $count_query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Comment added successfully.')</script>";
            }
            else{
                echo "<script type='text/javascript'>toastr.error('Could not post the comment.')</script>";
            }
        }
    }
}

function delete_comment(){
    global $connection;

    if (isset($_GET['delete'])){
        $commentID = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_ID = '$commentID'";
        $result = mysqli_query($connection,$query);
        if ($result){
            echo "<script type='text/javascript'>toastr.success('Comment deleted successfully.')</script>";
        }
        else{
            echo "<script type='text/javascript'>toastr.error('Could not delete the comment.')</script>";
        }
    }
}

function unapprove_comment(){
    global $connection;

    if (isset($_GET['unapprove'])){
        echo $commentID = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapprove' WHERE comment_ID = '$commentID'";
        $result = mysqli_query($connection, $query);

        if (isset($_GET['p_id'])){
            $PostID = $_GET['p_id'];
            $count_query = "UPDATE posts SET post_comments_count = post_comments_count - 1 WHERE postID = '$PostID'";
            $update_count = mysqli_query($connection, $count_query);
        }

        if ($result){
            echo "<script type='text/javascript'>toastr.success('Comment unapproved successfully.')</script>";
        }
        else{
            echo "<script type='text/javascript'>toastr.error('Could not unapprove the comment.')</script>";
        }
    }
}

function approve_comment(){
    global $connection;

    if (isset($_GET['approve'])){
        $commentID = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_ID = '$commentID';";
        $result = mysqli_query($connection, $query);

        if (isset($_GET['p_id'])){
            $PostID = $_GET['p_id'];
            $count_query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE postID = '$PostID'";
            $update_count = mysqli_query($connection, $count_query);
        }

        if ($result){
            echo "<script type='text/javascript'>toastr.success('Comment approved successfully.')</script>";
        }
        else{
            echo "<script type='text/javascript'>toastr.error('Could not approve the comment.')</script>";
        }
    }
}
?>