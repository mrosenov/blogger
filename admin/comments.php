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
              <li class="breadcrumb-item active">Legacy User Menu</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <?php include ('includes/list_all_comments.php'); ?>
            </div>

        </div>
    </section>
  </div>
<?php
include('includes/footer.php');
?>
