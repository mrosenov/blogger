<?php include('includes/header.php'); ?>
<div class="wrapper">
    <?php include('includes/navigation.php'); ?>
    <?php include('includes/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <a href="users.php?source=add_user" class="btn btn-block btn-success" style="width: 120px;">
                  <i class="fa-regular fa-circle-plus"></i> Add User
              </a>
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
                <?php
                if (isset($_GET['source'])){
                    $source = $_GET['source'];
                }
                else {
                    $source = '';
                }
                switch ($source){
                    case 'add_user';
                        include('add_user.php');
                        break;

                    case 'edit_user';
                        include('edit_user.php');
                        break;

                    default:
                        include ('includes/list_all_users.php');
                        break;
                }

                ?>

            </div>

        </div>
    </section>
  </div>
<?php
include('includes/footer.php');
?>
