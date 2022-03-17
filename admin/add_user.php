<?php
create_account();
?>
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Account Creating</h3>
        </div>
        <form action="" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="user_image">Profile Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="user_image" accept="image/*">
                        <label class="custom-file-label" for="user_image">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_role">User Role</label>
                    <select name="user_role" class="form-control" id="user_role">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>


            </div>
            <div class="card-footer">
                <button name="create_account" type="submit" class="btn btn-primary">Create Account</button>
            </div>
        </form>
 </div>