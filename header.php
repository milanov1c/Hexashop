<?php
include "logic/function.php";
include "logic/connect.php";
?>
<header class="header-area header-sticky">
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="main-nav">
                <!-- ***** Logo Start ***** -->
                <a href="index.php" class="logo">
                    <img src="assets/images/logo.png">
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                    <?php
                        $links=getAll("navigation");
                        echo displayMenu($links);
                    ?>
<!--                    <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>-->
<!--                    <li class="scroll-to-section"><a href="shop.php" >Shop</a></li>-->
<!--                    <li class="scroll-to-section"><a href="about.php" >About</a></li>-->
<!--                    <li class="scroll-to-section"><a href="contact.php" >Register</a></li>-->
<!--                    <li class="scroll-to-section"><a href="login.php" >Log In</a></li>-->
<!----->
                  <?php if(isLogged()):?>
                            <li><a href="logic/logout.php">Logout</a></li>
                            <li><a href="edit-account.php">Edit Account</a></li>
                            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                  <?php endif;?>
                    <?php if(isAdmin()):?>
                        <li><a href="admin/admin-panel.php">Admin Panel</a></li>
                    <?php endif;?>


                </ul>
                <a class='menu-trigger'>
                    <span>Menu</span>
                </a>
                <!-- ***** Menu End ***** -->
            </nav>
        </div>
    </div>
</div>
</header>