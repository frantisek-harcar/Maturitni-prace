<?php 
  require_once('./includes/db.inc.php');
  require_once('./includes/component.inc.php');
  require_once('./includes/cartTotalCount.inc.php');
  require("./header.php");
?>

  <title>Sunable - Shop</title>
  <body class="white">
    <section>
    <!-- Košík -->
      <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart mt-2 pt-2">
                    <h3 class="colored">Košík</h3>
                    <hr />
                    <div class="cart-items">
                    <?php 
                    /*Položky v košíku */
                    $total = 0;
                    $totalCount = 0;
                    if (isset($_SESSION['cart'])) {
                        $productId = array_column($_SESSION['cart'], 'productId');
                        $result = getData($conn);
                        while ($row = mysqli_fetch_assoc($result)){
                          /*Vypíše položku pro každý index v poli*/
                          foreach ($productId as $id){
                            if ($row['idProduct'] == $id) {
                              cartComponent($row['nameProduct'], $row['priceProduct'], $row['imgProduct'], $row['imgAlt'], $row['idProduct'], $row['numberOfItems']);
                              $total += (int)$row['priceProduct'] * getTotalCountForProduct($row['idProduct']);
                              $totalCount += getTotalCountForProduct($row['idProduct']);
                              }
                            }
                          }
                      /*Pokud je košík prázdný*/
                    }else{
                      unset($_SESSION['cart']);
                      echo "<h6 class='colored'> Košík je prázdný. </h6>";
                    }
                    ?>
                    </div>
                </div>
            </div>

            <!-- Detaily o platbě -->
            <div class="col-md-4 offset-md-1 border-top rounded mt-5 bg-white">
              <div class="pt-4">
                <h6>Detaily o platbě</h6>
                <hr />
                <div class="row price-details">
                  <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['cart'])) {
                      if ($totalCount < 5) {
                        echo "<h6>Cena ($totalCount položky)</h6>";
                      } else {
                        echo "<h6>Cena ($totalCount položek)</h6>";
                      }
                      
                    } else {
                      echo "<h6>Cena (0 položek)</h6>";
                    }
                    ?>
                    <h6>Poštovné</h6>
                    <hr>
                    <h6>Celková cena</h6>
                  </div>
                  <div class="col-md-6">
                    <?php 
                    echo "<h6>$total Kč</h6>"
                    ?>
                    <h6 class="text-success">ZDARMA</h6>
                    <hr>
                    <?php 
                    echo "<h6>$total Kč</h6>"
                    ?>
                  </div>
                </div>
              </div>
              <div class="row">
               <div class='col-md-5'>
                  <?php
                  // Pokud je v košíku položka, zobrazí tlačítko Vyprázdnit košík
                  if (isset($_SESSION['cart'])){
                    echo ("<form action='./includes/cart.inc.php' method='post'>
                        <button type='submit' class='btn btn-danger mt-2 mx-auto my-2 py-2' name='removeAll'>Vyprázdnit košík</button>
                      </form>");
                    }
                  ?>
                </div>
                <div class='col-md-4 offset-md-1'>
                  <?php
                  // Pokud je v košíku položka, zobrazí tlačítko Objednat
                  if (isset($_SESSION['cart'])){
                    echo "
                    <form action='order.php' method='post'>
                      <button type='submit' class='btn btn-success mt-2 mx-auto my-2 py-2' name='order'>Objednat</button>
                      <input type='hidden' name='total' value='$total'>
                      <input type='hidden' name='totalCount' value='$totalCount'>
                    </form>
                    ";
                  }
                  ?>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
  </body>
  <script type="text/javascript" src="js/cart.js"></script>