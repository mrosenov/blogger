<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>

<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <?php list_posts(); ?>
                    <nav aria-label='Page navigation example' style='margin-top: 10px;'>
                        <ul class='pagination justify-content-center'>
                            <?php list_pages(); ?>
                         </ul>
                    </nav>

                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
