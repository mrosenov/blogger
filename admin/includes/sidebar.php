<?php
function PageName() {
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
$current_page = PageName();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active':NULL ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="posts.php" class="nav-link <?php echo $current_page == 'posts.php' ? 'active':NULL ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Posts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="categories.php" class="nav-link <?php echo $current_page == 'categories.php' ? 'active':NULL ?>">
                        <i class="nav-icon fas fa-arrow-down-a-z"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo $current_page == 'comments.php' ? 'active':NULL ?>">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Comments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo $current_page == 'listusers.php' ? 'active':NULL ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>