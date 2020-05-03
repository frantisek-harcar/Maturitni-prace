<?php
require_once("./includes/admin.inc.php");
require_once("./header.php");
require_once("./includes/db.inc.php");
// Ověři, že je uživatel admin
if ($_SESSION['admin'] != 1) {
	header("location: ./index.php?error=permission");
  exit();
}
// Zprávy pro uživatele
if (isset($_GET['error'])) {
  $error = $_GET['error'];
  if ($error == 'fileSize') {
    echo ("<p class='error'>Soubor je příliš velký</p>");
  }
  elseif ($error == 'Error') {
    echo ("<p class='error'>Error</p>");
  }
  elseif ($error == 'wrongExt') {
    echo ("<p class='error'>Špatná koncovka (povoleny jsou: jpg, jpeg, png)</p>");
  }
}
if (isset($_GET['success'])) {
  $success = $_GET['success'];
  if ($success == 'adminItemAdded') {
    echo ("<p class='success'>Produkt byl přidán</p>");
  }
  elseif ($success == 'fileUploaded') {
    echo ("<p class='success'>Soubor byl nahrán</p>");
  }
}
// Formulář pro přidání produktu
if (isset($_GET['adminAdd'])) {
addItemForm();
}

// Formulář pro úpravu produktu
if (isset($_GET['adminEdit'])) {
  editItemForm($conn, $_GET['id']);
  }
?>
<!-- Tlačítko Zpět do shopu -->
<form action='./shop.php?admin' method="post">
  <button type='submit' class='btn mt-2 mx-4 my-2 py-2' name='adminShopBack'>Zpět do obchodu</a>
</form>
