<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>
<?php
    login_user();
    checkIfUserIsLoggedInAndRedirect('/blog/index');
?>
<link rel="stylesheet" href="/blog/css/signin.css">
<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <main class="form-signin text-center">
                        <form action="" method="post">
                            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                            <div class="form-group">
                                <label for='username' class='form-label'>Username</label>
                                <input name='username' type='text' class='form-control' id='username' placeholder='Username'>
                            </div>
                            <div class="form-group" style="margin-bottom: 5px;">
                                <label for='password' class='form-label'>Password</label>
                                <input name='password' type='password' class='form-control' id='password' placeholder='Password'>
                            </div>
                            <div class="d-grid gap-2">
                                <button name="login_account" class="w-100 btn btn-success" type="submit">Sign in</button>
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
