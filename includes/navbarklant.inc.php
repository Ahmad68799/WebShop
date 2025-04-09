<!-- NAVBAR -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="images/logo.png" width="95px">
            </div>
            <ul class="navbar">
                <li><a href="index.php?page=home" class="home-active">Home</a></li>
                <li><a href="index.php?page=men">Men</a></li>
                <li><a href="index.php?page=women">Women</a></li>

                <?php
                if (isset($_SESSION['user_id']) != null) {
                    echo '<li><a href="PHP/signout.php">Sign out</a></li>';

                }else{
                   echo '<li><a href="index.php?page=login">My Account</a></li>';
                }
                ?>
            </ul>
        </nav>
        <!-- icons -->
        <div class="icons">
            <a href="index.php?page=history">
            <i class='bx bx-history'></i>
            </a>
            <a href="index.php?page=shopingcart">
                <i class='bx bxs-basket' id="shopping_cart"></i>
            </a>
        </div>
    </div>
</header>
<!-- NAVBAR XXX -->