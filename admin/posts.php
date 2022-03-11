<?php include('includes/header.php'); ?>
<div class="wrapper">
    <?php include('includes/navigation.php'); ?>
    <?php include('includes/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Legacy User Menu</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of all posts</h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th class="sorting">Post ID</th>
                                                <th class="sorting">Category ID</th>
                                                <th class="sorting">Post Title</th>
                                                <th class="sorting">Post Author</th>
                                                <th class="sorting">Post Tags</th>
                                                <th class="sorting">Post Comments</th>
                                                <th class="sorting">Post Status</th>
                                                <th class="sorting">Post Created</th>
                                                <th class="sorting">Post Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = "SELECT * FROM posts";
                                                $result = mysqli_query($connection,$query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $postID = $row['postID'];
                                                    $catID = $row['catID'];
                                                    $post_title = $row['post_title'];
                                                    $post_author = $row['post_author'];
                                                    $post_tags = $row['post_tags'];
                                                    $post_comments = $row['post_comments_count'];
                                                    $post_status = $row['post_status'];
                                                    $created_at = $row['created_at'];
                                                    $updated_at = $row['updated_at'];
                                                    echo "
                                                    <tr class='odd'>
                                                        <td>$postID</td>
                                                        <td>$catID</td>
                                                        <td>$post_title</td>
                                                        <td>$post_author</td>
                                                        <td>$post_tags</td>
                                                        <td>$post_comments</td>
                                                        <td>$post_status</td>
                                                        <td>$created_at</td>
                                                        <td>$updated_at</td>
                                                    </tr>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $result = mysqli_query($connection,$query);
                                            if ($count = mysqli_num_rows($result))
                                            {
                                                echo "Showing $count Posts";
                                            }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous" id="example2_previous">
                                                <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active">
                                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                            </li>
                                            <li class="paginate_button page-item ">
                                                <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                            </li>
                                            <li class="paginate_button page-item next disabled" id="example2_next">
                                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
  </div>
<?php
include('includes/footer.php');
?>
