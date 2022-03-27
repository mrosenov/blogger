<div class="card">
    <div class="card-body">
        <?php
            login_user();
            if (!isset($_SESSION['user_role'])){
                echo "
            <form action='' method='post'>
                <div class='mb-3'>
                    <label for='username' class='form-label'>Username</label>
                    <input name='username' type='text' class='form-control' id='username' placeholder='Username'>
                </div>
                <label for='password' class='form-label'>Password</label>
                <div class='input-group'>
                    <input name='password' type='password' class='form-control' id='password' placeholder='Password'>
                    <button name='login_account' class='btn btn-success' type='submit'>Login</button>
                </div>
            </form>";
            }
            else{
                echo "Logged as: " . $_SESSION['username'];
                echo "
                <div class='mb-3'>
                    <a href='logout.php' class='btn btn-info'>Log out</a>
                </div>";
            }
        ?>
    </div>
</div>