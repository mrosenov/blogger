<?php edit_account(); ?>
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Account Editing</h3>
        </div>
        <?php
            if (isset($_GET['u_id'])){
                $user_ID = $_GET['u_id'];
                $query = "SELECT * FROM users WHERE user_ID = '$user_ID'";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)){
                    $username = $row['username'];
                    $password = $row['password'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $image = $row['user_image'];
                    $user_role = $row['user_role'];
                }
            }
        ?>
        <form action="" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" value="<?php echo $password; ?>">
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label for="user_image">Profile Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="user_image" accept="image/*" value="<?php echo $image; ?>">
                        <label class="custom-file-label" for="user_image">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_role">User Role</label>
                    <select name="user_role" class="form-control" id="user_role">
                        <?php
                            $user_ID = $_GET['u_id'];
                            $query = "SELECT users.user_ID,users.user_role,user_roles.role_ID,user_roles.role_name FROM users LEFT JOIN user_roles ON users.user_role = user_roles.role_ID WHERE user_ID = '$user_ID'";
                            $result = mysqli_query($connection,$query);

                            while ($row = mysqli_fetch_assoc($result)){
                                $role_ID = $row['role_ID'];
                                $role_name = $row['role_name'];
                                echo "<option value='$role_ID' selected>Current: $role_name</option>";
                            }
                            $query = "SELECT * FROM user_roles";
                            $result = mysqli_query($connection,$query);
                            while ($row = mysqli_fetch_assoc($result)){
                                $role_ID = $row['role_ID'];
                                $role_name = $row['role_name'];
                                echo "<option value='$role_ID'>$role_name</option>";
                            }
                        ?>
                    </select>
                </div>


            </div>
            <div class="card-footer">
                <button name="edit_account" type="submit" class="btn btn-primary">Edit Account</button>
            </div>
        </form>
 </div>