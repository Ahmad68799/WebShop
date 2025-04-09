<!-- NAVBAR -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="images/logo.png" width="95px">
            </div>
            <ul class="navbar">
                <li><a href="index.php?page=categoriesmanage" class="home-active">Manage Category's</a></li>
                <li><a href="index.php?page=addcategories">Add Category's</a></li>
                <li><a href="index.php?page=productsmanage">Manage Products</a></li>
                <?php
                if (isset($_SESSION['user_id']) != null) {
                    echo '<li><a href="PHP/signout.php">Sign out</a></li>';

                }else{
                    echo '<li><a href="index.php?page=login">My Account</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
<!-- NAVBAR XXX -->