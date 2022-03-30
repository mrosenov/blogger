<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>
<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'Classes/Config.php';
    login_user();
    checkIfUserIsLoggedInAndRedirect('/blog/index');

   if (!isset($_GET['token'])){
        redirect('/blog/index');
    }

?>
<link rel="stylesheet" href="/blog/css/signin.css">
<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <main class="form-signin text-center">
                        <?php request_password(); ?>
                        <form action="" method="post">
                            <h1 class="h3 mb-3 fw-normal">Forgotten Password?</h1>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                <input name="email" type="email" class="form-control" placeholder="Email">
                                <button name="request_password" class="btn btn-success" type="submit">Request Password</button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
    <?php include ("includes/footer.php"); ?>
