<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>
<?php
    login_user();
    checkIfUserIsLoggedInAndRedirect('/blog/index');

    if (!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('/blog/index');
    }

    password_reset();
?>
<link rel="stylesheet" href="/blog/css/signin.css">
<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <main class="form-signin text-center">

                        <form action="" method="post">
                            <h1 class="h3 mb-3 fw-normal">Password Recovery</h1>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                            </div>
                            <div class="d-grid gap-2">
                                <button name="change_password" class="btn btn-success" type="submit">Change Password</button>
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
