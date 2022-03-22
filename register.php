<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>

<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title">Register</h5>
                        </div>
                        <?php register_account(); ?>
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Firstname">
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                                </div>

                            </div>
                            <div class="card-footer">
                                <button name="create_account" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
