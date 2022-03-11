<?php include('includes/header.php'); ?>
<div class="wrapper">
    <?php include('includes/navigation.php'); ?>
    <?php include('includes/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <?php
                        if (isset($_POST['CategoryCreate'])){
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
                    ?>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <input name="cat_title" type="text" class="form-control" placeholder="Category Title">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button name="CategoryCreate" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Categories</h3>
                    </div>
                    <div class="card-body">
                        <?php
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
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Category Title</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($connection,$query);

                                while ($row = mysqli_fetch_assoc($result)){
                                    $catID = $row['catID'];
                                    $cat_title = $row['catTitle'];
                                    echo "
                                    <tr>
                                        <td>$catID</td>
                                        <td>$cat_title</td>
                                        <td><a href='#'>Edit</a> | <a href='categories.php?delete=$catID'>Delete</a></td>
                                    </tr> ";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
<?php
include('includes/footer.php');
?>
