<?php 
  require_once("./includes/db.inc.php");
  require("./header.php");
  if (!isset($_POST['order'])) {
    header("location: ./index.php?error=accesDenied");
    exit();
  }
?>
  <title>Sunable - Order</title>
  <body class="white">
    <section>
    <!-- Kontaktní informace -->
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart mt-2 pt-2">
                    <h3 class="colored">Kontaktní informace</h3>
                    <hr />
                    <!--Kontaktní formulář-->
                    <form action='./includes/order.inc.php?' method='post'>
                      <div class='border rounded'>
                          <div class='row bg-black'>
                              <div class='col-md-1 pl-0'>
                              
                                </div>
                                  <div class='col-md-6'>
                                      Jméno<br>
                                      <input type="text" name="firstname" autocomplete="on"  required> <br>
                                      Příjmení<br>
                                      <input type="text" name="lastname" autocomplete="on"  required> <br>
                                      E-mail <br>
                                      <input type="email" name="mail" autocomplete="on" required> <br>
                                      Telefon <br> 
                                      <input type="tel" name="phone" autocomplete="on" pattern="^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$" required> <br>
                                      <div class="my-2">
                                        <input type="radio" checked> Dobírkou <br>
                                        <input type="radio" disabled> Platební kartou <br>
                                        <input type="radio" disabled> Bankovním převodem <br>
                                      </div>
                                      <div class="my-2">
                                        <input type="checkbox" required> Souhlasím s <a href="#" class="colored">obchodními podmínkami</a>. <br>                            
                                      </div>
                                      <button type='submit' class='btn btn-success mt-2 mx-auto my-2 py-2' name='orderConfirm'>Potvrdit Objednávku</button>
                                  </div>
                                <div class='col-md-3'>
                                Město <br>
                                <input type="text" name="city" autocomplete="on" required> <br>
                                Adresa <br>
                                <input type="text" name="address" autocomplete="on" required> <br>
                                PSČ <br>
                                <input type="text" name="postcode" autocomplete="on" placeholder="např. 123 45" pattern ="\d{3} ?\d{2}" required> <br>
                                Stát <br>
                                <select type="country" class="mb-4">
                                <option value="CZ" selected="selected">Česká republika</option>
                                </select>
                              </div>
                          </div>
                      </div>
                    </form>
                </div>
            </div>

            <!-- Detaily o platbě -->
            <div class="col-md-4 offset-md-1 border border-right-0 border-bottom-0 rounded mt-5 bg-white">
              <div class="pt-4">
                <h6>Detaily o platbě</h6>
                <hr />
                <div class="row price-details">
                  <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['cart'])) {
                      if ($_POST['totalCount'] < 5) {
                        echo "<h6>Cena (" . $_POST['totalCount'] . " položky)</h6>";
                      } else {
                        echo "<h6>Cena (" . $_POST['totalCount'] . " položek)</h6>";
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
                    echo "<h6>" . $_POST['total'] . " Kč</h6>"
                    ?>
                    <h6 class="text-success">ZDARMA</h6>
                    <hr>
                    <?php 
                    echo "<h6>" . $_POST['total'] . " Kč</h6>"
                    ?>
                  </div>
                </div>
              </div>
    </section>
  </body>