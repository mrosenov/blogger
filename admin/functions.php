<?php

$uniqID = uniqid(true);

function redirect($location){
    header("Location:" . $location);
    exit;
}

function list_posts(){
    global $connection;
    if (isset($_GET['page'])){
        $GLOBALS['page'] = $_GET['page'];
    }
    else{
        $GLOBALS['page'] = "";
    }

    if ($GLOBALS['page'] == "" || $GLOBALS['page'] == 1){
        $page_1 = 0;
    }
    else{
        $page_1 = ($GLOBALS['page'] * 5) - 5;
    }
    $query = "SELECT * FROM posts WHERE post_status = 'Approved' LIMIT $page_1,5";
    $result = mysqli_query($connection,$query);

    $count = mysqli_num_rows($result);
    if($count == 0){
        echo "
            <div class='alert alert-danger' role='alert'>
              There are no posts
            </div>";
    }
    else{

        while ($row = mysqli_fetch_assoc($result)){
            $postID = $row['postID'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_content = substr($row['post_content'],0,400);
            $post_date = $row['created_at'];
            $count_comments_query = mysqli_query($connection,"SELECT * FROM comments where post_ID = '$postID' AND comment_status = 'Approved'");
            $count_comments = mysqli_num_rows($count_comments_query);
            echo "
                            <div class='card' style='margin-top: 5px;'>
                                <div class='card-header'>
                                    <a href='post/$postID'>$post_title</a>
                                </div>
                                <div class='card-body'>
                                    <p class='card-text'>$post_content</p>
                                </div>
                                <div class='card-footer text-muted'>
                                    Author: <a href='author_posts/$post_author'>$post_author</a>  | Published: $post_date | Comments: $count_comments | <a href='post.php?p_id=$postID' class='btn btn-sm btn-dark'>Read More</a>
                                </div>
                            </div>";
        }
    }
}

function list_pages(){
    global $connection;

    $count_query = "SELECT * FROM posts WHERE post_status = 'Approved'";
    $count_execute = mysqli_query($connection, $count_query);
    $count2 = mysqli_num_rows($count_execute);
    if ($count2 <= 0){
        echo "";
    }
    else{
        $count2 = ceil($count2 / 5);
        for ($i = 1; $i <= $count2; $i++){
            if ($i == $GLOBALS['page']){
                echo "<li class='page-item active'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
            }
            else {
                echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
            }
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
            $query = "INSERT INTO posts (catID,post_title,post_author,post_content,post_tags,post_comments_count,post_status,post_date,created_at,updated_at) VALUES ('$categoryID','$post_title','$post_author','$post_content','$post_tags','0','$post_status','$post_date','$created_at','$updated_at')";
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

    if (isset($_SESSION['user_role']) == '1'){
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
    else{
        echo "No rights to do it";
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

    if (isset($_SESSION['user_role']) == '1'){
        if (isset($_GET['delete'])){
            $catID = $_GET['delete'];
            $query = "DELETE FROM categories WHERE catID = $catID";
            $result = mysqli_query($connection,$query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Category deleted successfully.')</script>";
            }
            else {
                echo"<script type='text/javascript'>toastr.error('Could not delete the category.')</script>";
            }
        }
    }
    else{
        echo "No rights to do it";
    }
}

function list_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection,$query);

    if (mysqli_num_rows($result) == 0 ){
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

    if (isset($_SESSION['user_role']) == '1'){
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
    else{
        echo "No rights to do it";
    }
}

function unapprove_comment(){
    global $connection;

    if (isset($_SESSION['user_role']) == '1'){
        if (isset($_GET['unapprove'])){
            if (isset($_GET['p_id'])){
                $commentID = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_ID = '$commentID'";
                $result = mysqli_query($connection, $query);
                if ($result){
                    echo "<script type='text/javascript'>toastr.success('Comment unapproved successfully.')</script>";
                }
            }
        }
    }
    else{
        echo "No rights to do it";
    }
}

function approve_comment(){
    global $connection;

    if (isset($_SESSION['user_role']) == '1'){
        if (isset($_GET['approve'])){
            if (isset($_GET['p_id'])){
                $commentID = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_ID = '$commentID';";
                $result = mysqli_query($connection, $query);
                if ($result){
                    echo "<script type='text/javascript'>toastr.success('Comment approved successfully.')</script>";
                }
            }
        }
    }
    else{
        echo "No rights to do it";
    }
}

function create_account(){
    global $connection;

    if (isset($_POST['create_account'])){
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);
        $created_at = date("Y-m-d h:i:sa");
        $updated_at = date("Y-m-d h:i:sa");

        if ($username == "" || empty($username)){
            echo "<script type='text/javascript'>toastr.error('Please add username')</script>";
        }
        elseif ($password == "" || empty($password)){
            echo "<script type='text/javascript'>toastr.error('Please add password.')</script>";
        }
        elseif ($firstname == "" || empty($firstname)){
            echo "<script type='text/javascript'>toastr.error('Please add firstname.')</script>";
        }
        elseif ($lastname == "" || empty($lastname)){
            echo "<script type='text/javascript'>toastr.error('Please add lastname.')</script>";
        }
        elseif ($email == "" || empty($email)){
            echo "<script type='text/javascript'>toastr.error('Please add email.')</script>";
        }
        elseif ($user_role == "" || empty($user_role)){
            echo "<script type='text/javascript'>toastr.error('Please add role.')</script>";
        }
        else {
            $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
            $query = "INSERT INTO users (username,password,firstname,lastname,email,user_role,created_at,updated_at) VALUES ('$username','$password','$firstname','$lastname','$email','$user_role','$created_at','$updated_at')";
            $result = mysqli_query($connection, $query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Account created successfully.')</script>";
            }
            else {
                echo "<script type='text/javascript'>toastr.error('Account could not be created.')</script>";
            }
        }
    }
}

function delete_account(){
    global $connection;

    if (isset($_SESSION['user_role']) == '1'){
        if (isset($_GET['delete'])){
            $user_ID = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_ID = '$user_ID'";
            $result = mysqli_query($connection, $query);
            if ($result){
                echo "<script type='text/javascript'>toastr.success('Account deleted successfully.')</script>";
            }
            else {
                echo "<script type='text/javascript'>toastr.error('Account could not be deleted.')</script>";
            }
        }
    }
    else{
        echo "No rights to do it";
    }

}

function edit_account(){
    global $connection;

    if (isset($_POST['edit_account'])){
        $user_ID = $_GET['u_id'];
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);
        $updated_at = date("Y-m-d h:i:sa");

        $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
        $query = "UPDATE users SET username = '$username',password = '$password',firstname = '$firstname',lastname = '$lastname',email = '$email',user_role='$user_role',updated_at = '$updated_at' WHERE user_ID = '$user_ID'";
        $result = mysqli_query($connection, $query);
        if ($result){
            echo "<script type='text/javascript'>toastr.success('Account edited successfully.')</script>";
        }
        else{
            echo "<script type='text/javascript'>toastr.error('Account could not be edited.')</script>";
        }
    }
}

function Bulk_Option_Posts(){
    global $connection;

    if (isset($_POST['CheckBoxArray'])){
        foreach($_POST['CheckBoxArray'] as $CheckBoxValue){
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options){
                case 'approved':
                    $Publish = "UPDATE posts SET post_status = '$bulk_options' WHERE postID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Publish);
                    break;
                case 'draft':
                    $Draft = "UPDATE posts SET post_status = '$bulk_options' WHERE postID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Draft);
                    break;
                case 'delete':
                    $Delete = "DELETE FROM posts WHERE postID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Delete);
                    break;
                case 'clone':
                    $Delete = "SELECT * FROM posts WHERE postID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Delete);
                    while ($row = mysqli_fetch_assoc($result)){
                        $categoryID = mysqli_real_escape_string($connection,$row['catID']);
                        $post_title = mysqli_real_escape_string($connection,$row['post_title']);
                        $post_author = mysqli_real_escape_string($connection,$row['post_author']);
                        $post_content = mysqli_real_escape_string($connection,$row['post_content']);
                        $post_tags = mysqli_real_escape_string($connection,$row['post_tags']);
                        $comment_count = mysqli_real_escape_string($connection,$row['post_comments_count']);
                        $post_status = mysqli_real_escape_string($connection,$row['post_status']);
                        $post_date = mysqli_real_escape_string($connection,$row['post_date']);
                        $created_at = date("Y-m-d h:i:sa");
                        $updated_at = date("Y-m-d h:i:sa");

                        $query = "INSERT INTO posts (catID,post_title,post_author,post_content,post_tags,post_comments_count,post_status,post_date,created_at,updated_at) VALUES ('$categoryID','$post_title','$post_author','$post_content','$post_tags','0','$post_status','$post_date','$created_at','$updated_at')";
                        $duplicateEntry = mysqli_query($connection,$query);
                    }
                    break;
            }
        }
    }
}

function Bulk_Option_Comments(){
    global $connection;

    if (isset($_POST['CheckBoxArray'])){
        foreach($_POST['CheckBoxArray'] as $CheckBoxValue){
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options){
                case 'Approved':
                    $Approved = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_ID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Approved);
                    break;
                case 'Unapproved':
                    $Draft = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_ID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Draft);
                    break;
                case 'delete':
                    $Delete = "DELETE FROM comments WHERE comment_ID = '$CheckBoxValue'";
                    $result = mysqli_query($connection,$Delete);
                    break;
            }
        }
    }
}

function register_account(){
    global $connection;

    if (isset($_POST['create_account'])){
        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $created_at = date("Y-m-d h:i:sa");
        $updated_at = date("Y-m-d h:i:sa");

        if (username_exists($username)){
            echo "<script type='text/javascript'>toastr.error('Username already exists.')</script>";
        }
        elseif (email_exists($email)){
            echo "<script type='text/javascript'>toastr.error('Email already exists.')</script>";
        }
        else{
            if ($username == "" || empty($username)){
                echo "<script type='text/javascript'>toastr.error('Please add username')</script>";
            }
            elseif ($password == "" || empty($password)){
                echo "<script type='text/javascript'>toastr.error('Please add password.')</script>";
            }
            elseif ($firstname == "" || empty($firstname)){
                echo "<script type='text/javascript'>toastr.error('Please add firstname.')</script>";
            }
            elseif ($lastname == "" || empty($lastname)){
                echo "<script type='text/javascript'>toastr.error('Please add lastname.')</script>";
            }
            elseif ($email == "" || empty($email)){
                echo "<script type='text/javascript'>toastr.error('Please add email.')</script>";
            }
            else {
                $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));
                $query = "INSERT INTO users (username,password,firstname,lastname,email,user_role,created_at,updated_at) VALUES ('$username','$password','$firstname','$lastname','$email','2','$created_at','$updated_at')";
                $result = mysqli_query($connection, $query);
                if ($result){
                    echo "<script type='text/javascript'>toastr.success('Account created successfully.')</script>";
                }
                else {
                    echo "<script type='text/javascript'>toastr.error('Account could not be created.')</script>";
                }
            }
        }
    }
}
function list_online_users(){
    global $connection;

    $session = session_id();
    $time = time();
    $time_seconds = 60;
    $time_out = $time - $time_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $ext_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($ext_query);

    if ($count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES ('$session','$time')");
    }
    else{
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }
    $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    $GLOBALS['online'] = mysqli_num_rows($users_online);
}

function login_user(){
    global $connection;

    if (isset($_POST['login_account'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)){
            $db_user_ID = $row['user_ID'];
            $db_username = $row['username'];
            $db_password = $row['password'];
            $db_firstname = $row['firstname'];
            $db_lastname = $row['lastname'];
            $db_email = $row['email'];
            $db_user_role = $row['user_role'];

            if (password_verify($password,$db_password)) {
                $_SESSION['username'] = $db_username;
                $_SESSION['user_role'] = $db_user_role;
                $_SESSION['firstname'] = $db_firstname;
                $_SESSION['lastname'] = $db_lastname;
            }
        }
        if ($username = '' || empty($username)){
            echo "fill username";
        }
        elseif ($password = '' || empty($password)){
            echo "fill password";
        }
    }
}

function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0){
        return true;
    }
    else{
        return false;
    }
}

function email_exists($email){
    global $connection;

    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0){
        return true;
    }
    else{
        echo "Nqma takav mail";
        return false;
    }
}

function ifItIsMethod($method=null){
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function isLoggedIn(){
    if (isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if (isLoggedIn()){
        redirect($redirectLocation);
    }
}

function request_password(){
    global $connection;

    if (ifItIsMethod('post')){
        if (isset($_POST['request_password'])){
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if (email_exists($email)){
                $stmt = mysqli_prepare($connection,"UPDATE users SET token='$token' WHERE email=?");
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $mail = new \PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->Host = Config::SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Port = Config::SMTP_PORT;
                $mail->Username = Config::SMTP_USER;
                $mail->Password = Config::SMTP_PASSWORD;
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('mitkorosenov@live.com','Mitko Rosenov');
                $mail->addAddress($email);

                $mail->Subject = 'test email';
                $mail->Body = '<p>Click the following link in order to reset your password - <a href="http://localhost/blog/reset.php?email='.$email.'&token='.$token.'">reset password</a></p>';

                if ($mail->send()){
                    echo "<script type='text/javascript'>toastr.success('Check your email for instructions.')</script>";
                }
                else{
                    echo "<script type='text/javascript'>toastr.error('Something went wrong and we could not send you email.')</script>";
                }
            }
        }
    }
}

function password_reset(){
    global $connection;

    if ($stmt = mysqli_prepare($connection, 'SELECT username,email,token FROM users WHERE token=?')){
        mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (isset($_POST['password']) && isset($_POST['confirm_password'])){
            if ($_POST['password'] === $_POST['confirm_password']){
                $password = $_POST['password'];
                $hashed_password = password_hash($password,PASSWORD_DEFAULT, array('cost'=>12));
                if ($stmt = mysqli_prepare($connection,"UPDATE users SET token='', password='$hashed_password' WHERE email = ?")){
                    mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
                    mysqli_stmt_execute($stmt);

                    if (mysqli_stmt_affected_rows($stmt) >= 1){
                        echo "<script type='text/javascript'>toastr.success('Password has been changed.')</script>";
                    }
                }
            }
            else{
                echo "<script type='text/javascript'>toastr.error('Please make sure both passwords are same.')</script>";
            }
        }
    }
}

function loggedInUserID() {
    global $connection;

    if (isLoggedIn()){
        $result = mysqli_query($connection, "SELECT * FROM users WHERE username ='".$_SESSION['username']."'");
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_ID'] : false;
    }
    return false;
}

function PostLike($post_id = ''){
    global $connection;

    $result = mysqli_query($connection,"SELECT * FROM post_likes WHERE user_id=" .loggedInUserID() . " AND Post_ID='$post_id'");
    return mysqli_num_rows($result) >= 1 ? true : false;
}

function GetPostLikes($PostID){
    global $connection;

    $query = "SELECT * FROM post_likes WHERE Post_ID = '$PostID'";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);
}

?>