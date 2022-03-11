<?php

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
            echo "<script type='text/javascript'>toastr.success('Category added successfully.')</script>";
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
            $catID = $row['catID'];
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
                echo "<script type='text/javascript'>toastr.success('Category updated successfully.')</script>";
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
?>