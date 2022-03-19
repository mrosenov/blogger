<?php include('includes/header.php'); ?>
<div class="wrapper">
    <?php include('includes/navigation.php'); ?>
    <?php include('includes/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Legacy User Menu</h1>
          </div>
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
            <?php
                $query = "SELECT (SELECT COUNT(*)FROM posts) AS posts,(SELECT COUNT(*)FROM users) AS users,(SELECT COUNT(*)FROM comments) AS comments,(SELECT COUNT(*)FROM categories) AS categories,(SELECT COUNT(*)FROM posts WHERE post_status = 'draft') AS draft_posts,(SELECT COUNT(*) FROM comments WHERE comment_status = 'Unapproved') AS draft_comments FROM dual";
                $result = mysqli_query($connection, $query);
                $count_posts = mysqli_fetch_assoc($result);
            ?>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $count_posts['posts']; ?></h3>
                        <p>New Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fa-light fa-file"></i>
                    </div>
                    <a href="posts.php" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $count_posts['comments']; ?></h3>
                        <p>Comments</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <a href="comments.php" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $count_posts['users']; ?></h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="users.php" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $count_posts['categories']; ?></h3>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <a href="categories.php" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([

                    ['Data', 'Count'],
                    <?php
                        $chart_colums = ['Active Posts','Draft Posts', 'Categories', 'Users', 'Comments','Pending Comments'];
                        $chart_data = [$count_posts['posts'],$count_posts['draft_posts'], $count_posts['categories'], $count_posts['users'], $count_posts['comments'],$count_posts['draft_comments']];

                        for ($i = 0; $i < 6; $i++) {
                            echo "['$chart_colums[$i]','$chart_data[$i]'],";
                        }
                    ?>
                ]);
                data.sort([{column: 1, desc:false}, {column: 0}]);
                var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    }
                };
                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        <div id="columnchart_material" style="width: auto; height: 500px;"></div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <?php
            echo "Username:" . $_SESSION['username'];
            echo "Role_ID:" . $_SESSION['user_role'];
            ?>

          <br>
          Start creating your amazing application!
        </div>
        <div class="card-footer">
          Footer
        </div>
      </div>

    </section>
  </div>

<?php include('includes/footer.php'); ?>
