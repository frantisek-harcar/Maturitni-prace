<?php
require_once('./db.inc.php');
require_once('../PHPMailer/PHPMailerAutoload.php');
require_once('./cartTotalCount.inc.php');

if (isset($_POST['orderConfirm'])) {
  // Vypočítá cenu
  $total = 0;
  $productName = "";
  $productIds = array_column($_SESSION['cart'], 'productId');
  $result = getData($conn);
  while ($row = mysqli_fetch_assoc($result)){
    foreach ($productIds as $id){
      if ($row['idProduct'] == $id) {
        $total += (int)$row['priceProduct'];
      }
    }
  }
  // Vytáhne všechny počty produktů
  $productsCounts = [];
  foreach ($productIds as $productId) {
    // Prochází Id
    $productsCounts[$productId] = 
    getTotalCountForProduct($productId);
  }

  //Inicializace proměnných z formuláře
  //$shipTo = ($_POST['city'] . " " . $_POST['address'] . " " . $_POST['postcode']);
  $orderPerson = ($_POST['firstname'] . " " . $_POST['lastname']);
  $orderMail = $_POST['mail'];
  $orderPhone = $_POST['phone'];
  $orderCity = $_POST['city'];
  $orderAddress = $_POST['address'];
  $orderPostcode = $_POST['postcode'];

  // Vložení objednávky do tabulky orders
  insertOrder($conn,$orderPerson, $orderMail, $orderPhone, $orderCity, $orderAddress, $orderPostcode);

  //Získá číslo poslední objednávky
  $result = mysqli_query($conn, "SELECT MAX(orderId) FROM orders");
  if (mysqli_num_rows($result) > 0) {
    $idOrder = mysqli_fetch_assoc($result);
    $actualIdOrder = $idOrder['MAX(orderId)'];
  }
  // Uloží ke každému ID počet položek
  // key = id produktu, value = jeho kvantita
  foreach ($productsCounts as $key => $value) {
    $sql = "INSERT INTO orders_record (orderId, orderProductId, numberOfItems) VALUES ($actualIdOrder, $key, $value);";
    mysqli_query($conn, $sql);
    // Odečte počet položek od celkového množství v DB
    $sql2 = "UPDATE products SET numberOfItems = numberOfItems - $value WHERE idProduct = $key;";
    mysqli_query($conn,$sql2);
    // Přičte počet prodaných položek
    $sql2 = "UPDATE products SET sellCount = sellCount + $value WHERE idProduct = $key;";
    mysqli_query($conn,$sql2);
  }

  // Odeslání emailu
  $mail = new PHPMailer;
  $mail->Host = 'smtp.seznam.cz';
  $mail->Port = '465';
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Username = 'sunable@seznam.cz';
  $mail->Password = 'maturitnipracetest';
  $mail->SetFrom('sunable@seznam.cz');
  $mail->AddAddress($_POST['mail']);
  $mail->isHTML(true);
  $mail->Subject = 'Order confirmed';
  $mail->Body = 'Order confirmed.';
  $mail->Send();

 //Pokud se email odešle, vynuluje košík a přesměruje na shop
 //if ($mail->send()) {
   $response = "Email is sent!";
     unset($_SESSION['cart']);
     header("location: ../shop.php?success=ordercomplete");
     exit();
     // Email se neodešle -> error
  // } else {
   //  $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
   //  exit(json_encode(array("response" => $response)));
  // }
  }

