<?php
if ( ! isset($_SESSION))
{
    session_start();
}

require_once 'includes/cartTotalCount.inc.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!--Font Awesome -->
	<script src="https://kit.fontawesome.com/5a3db46310.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
  <header class="showcase-small">
      <div class="showcase-top">
        <nav>
          <!-- Logo -->
          <a id = logo href="index.php"><img src="img/sunable.png" alt="Sunable"></a>
          <!-- Shop -->
          <a href="shop.php" class="btn btn-rounded shop">Shop</a>
          <!-- Login/Logout -->
          <?php
            if (isset($_SESSION['userId'])) {
                echo '<a href="includes/logout.inc.php" class="btn btn-rounded reg">Logout</a>';
            }else {
              echo '<a href="signup.php" class="btn btn-rounded reg">Login</a>';
            }
          ?>
          <!-- Cart -->
          <a id = shopcart href=cart.php class="nav-item nav-link active ">
            <i class="fas fa-shopping-cart"></i>Košík
            <?php

              if (isset($_SESSION['cart'])){

                  echo "<span id='cart_count' class='text-warning'>" . getTotalCount() . "</span>";
              }else{
                  echo "<span id='cart_count' class='text-warning'>0</span>";
              }
            ?>
          </a>
          <!-- Administrace -->
          <?php
          if (isset($_SESSION['userId'])) {
            if ($_SESSION['admin']) {
                    echo '<a href="administration.php" class="btn btn-rounded administration">Administrace</a>';
                  }
                }
					?>
        </nav>
      </div>
    </header>
