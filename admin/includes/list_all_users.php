<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of all users</h3>
    </div>
    <div class="card-body">
        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <?php delete_account(); ?>
                    <table class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                        <tr>
                            <th class="sorting">User ID</th>
                            <th class="sorting">Username</th>
                            <th class="sorting">Password</th>
                            <th class="sorting">Firstname</th>
                            <th class="sorting">Lastname</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Picture</th>
                            <th class="sorting">Role</th>
                            <th class="sorting">RandSalt</th>
                            <th class="sorting">Created At</th>
                            <th class="sorting">Last Updated</th>
                            <th class="sorting">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            //$query = "SELECT * FROM users";
                            $query = "SELECT * FROM users LEFT JOIN user_roles ON users.user_role = user_roles.role_ID";
                            $result = mysqli_query($connection,$query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $user_ID = $row['user_ID'];
                                $username = $row['username'];
                                $password = $row['password'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $email = $row['email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['role_name'];
                                $randSalt = $row['randSalt'];
                                $created_at = $row['created_at'];
                                $updated_at = $row['updated_at'];

                                echo "
                                <tr class='odd'>
                                    <td>$user_ID</td>
                                    <td>$username</td>
                                    <td>$password</td>
                                    <td>$firstname</td>
                                    <td>$lastname</td>
                                    <td>$email</td>
                                    <td>$user_image</td>
                                    <td>$user_role</td>
                                    <td>$randSalt</td>
                                    <td>$created_at</td>
                                    <td>$updated_at</td>
                                    <td><a href='users.php?delete=$user_ID' class='btn btn-danger'>Delete</a> <a href='users.php?source=edit_user&u_id=$user_ID' class='btn btn-warning'>Edit</a></td>
                                </tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
