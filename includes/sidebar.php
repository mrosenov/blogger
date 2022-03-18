<div class="card">
    <div class="card-body">
        <?php
            if (isset($_POST['login_account'])){
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $password = mysqli_real_escape_string($connection, $_POST['password']);
                $query = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)){
                    $db_user_ID = $row['user_ID'];
                    $db_username = $row['username'];
                    $db_password = $row['password'];
                    $db_firstname = $row['firstname'];
                    $db_lastname = $row['lastname'];
                    $db_email = $row['email'];
                    $db_user_role = $row['user_role'];

                    if ($username === $db_username && $password === $db_password) {
                        echo "logged";
                        echo $_SESSION['username'] = $db_username;
                        echo $_SESSION['user_role'] = $db_user_role;
                    }
                }
                if ($username = '' || empty($username)){
                    echo "fill username";
                }
                elseif ($password = '' || empty($password)){
                    echo "fill password";
                }
            }
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="Username">
            </div>
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <button name="login_account" class="btn btn-success" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>