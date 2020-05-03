<?php
require_once('db.inc.php');
function removeItem() {
  // Odebere z košíku
  if ($_GET['action'] == 'adminremove') {
    $id = $_GET['id'];
    foreach ($_SESSION['cart'] as $key => $value){
      if ($value['productId'] == $id) {
        unset($_SESSION['cart'][$key]);
        if (count($_SESSION['cart']) < 1) {
          unset($_SESSION['cart']);
        }
      }
    }
  }
}


// Formulář pro přidání položky
function addItemForm(){
  $element = "
  <form action='./includes/admin.inc.php?adminAddConfirm' method='post'>
    <div>
      <div class='row px-5 py-3'>
        <div class='col-md-6'>
          Název produktu<br>
          <input type='text' name='nameProduct' class='my-1' placeholder='Sunable Hoodie' required> <br>
          Prodejní cena produktu<br>
          <input type='text' name='priceProduct' class='my-1' placeholder='500' required> Kč <br>
          Cesta k obrázku (zadej název_souboru.png) <br>
          <input type='text' name='imgProduct' class='my-1' value='./products/' required> <br>
          imgAlt <br> 
          <input type='text' name='imgAlt' class='my-1' placeholder='krátky popis produktu' required> <br>
          Popis produktu <br>
          <input type='text' name='descriptionProduct' class='my-1' placeholder='např. Sunable merchandise' required> <br>
          Počet položek na skladě<br>
          <input type='text' name='numberOfItems' class='my-1' required> ks <br>
          Typ produktu <br>
          <select name='productType' class='my-1' requiered>
            <option value='hoodie'>Hoodie</option>
            <option value='hat'>Hat</option>
            <option value='tshirt'>T-shirt</option>
            <option value='shoes'>Shoes</option>
          </select> <br>
          
          <button type='submit' class='btnSuccess btn-success mt-2 mx-4 my-4 py-2' name='addConfirm'>Přidat položku</button>
        </div>
    </div>
  </form>
  Nahraj průhledný (.png) soubor o velikosti 1000x1172
  <form action='./includes/upload.inc.php' method='post' enctype='multipart/form-data'>
    <input type='file' name='file'><br>
    <button type='submit' class='btn mt-2 mx-4 my-4 py-2' name='uploadFile'>Nahrát obrázek</button>
  </form>
  ";
  echo $element;
  //<input type='text' name='productType' class='my-1' placeholder='hoodie, hat, tshirt, shoes...'> <br>
}

// Formulář pro úpravu položky
function editItemForm($conn, $id){
  $sql = "SELECT * FROM products WHERE idProduct = $id";
	$result = mysqli_query($conn,$sql);
  $productRow = mysqli_fetch_assoc($result);
  $productName = $productRow['nameProduct'];
  $productPrice = $productRow['priceProduct'];
  $productImg = $productRow['imgProduct'];
  $productAlt = $productRow['imgAlt'];
  $productDescription = $productRow['descriptionProduct'];
  $numberOfItems = $productRow['numberOfItems'];
  $productType = $productRow['productType'];
  $idProduct = $productRow['idProduct'];
  $element = "
  <form action='./includes/admin.inc.php?adminEditConfirm&id=$idProduct' method='post'>
    <div>
      <div class='row px-5 py-3'>
        <div class='col-md-6'>
          Název produktu<br>
          <input type='text' name='nameProduct' class='my-1' value='$productName' required> <br>
          Prodejní cena produktu<br>
          <input type='text' name='priceProduct' class='my-1' value='$productPrice' required> Kč <br>
          Cesta k obrázku (zadej název_souboru.png) <br>
          <input type='text' name='imgProduct' class='my-1' value='$productImg' required> <br>
          imgAlt <br> 
          <input type='text' name='imgAlt' class='my-1' value='$productAlt' required> <br>
          Popis produktu <br>
          <input type='text' name='descriptionProduct' class='my-1' value='$productDescription' required> <br>
          Počet položek na skladě<br>
          <input type='text' name='numberOfItems' class='my-1' value='$numberOfItems' required> ks <br>
          Typ produktu <br>
          <input type='text' name='productType' class='my-1' value='$productType' required> <br>
          <button type='submit' class='btnSuccess btn-success mt-2 mx-4 my-4 py-2' name='editConfirm'>Upravit položku</button>
        </div>
    </div>
  </form>
  <div class='mx-5'>
  Nahraj průhledný (.png) soubor o velikosti 1000x1172
  <form action='./includes/upload.inc.php' method='post' enctype='multipart/form-data'>
    <input class='mx-5 my-3' type='file' name='file'><br>
    <button type='submit' class='btn mt-2 mx-4 my-4 py-2' name='uploadFile'>Nahrát obrázek</button>
  </form>
  </div>
  ";
  echo $element;
}
// Přidá položku z formuláře do DB
if (isset($_POST['addConfirm'])){
  $nameProduct = $_POST['nameProduct'];
  $priceProduct = $_POST['priceProduct'];
  $imgProduct = $_POST['imgProduct'];
  $imgAlt = $_POST['imgAlt'];
  $descriptionProduct = $_POST['descriptionProduct'];
  $numberOfItems = $_POST['numberOfItems'];
  $productType = $_POST['productType'];

  insertItem($conn, $nameProduct ,$priceProduct, $imgProduct, $imgAlt, $descriptionProduct, $numberOfItems, $productType);
  header("location: ../adminform.php?adminAdd&success=adminItemAdded");
  exit();
}

// Upraví položku z formuláře v DB
if (isset($_POST['editConfirm'])){
  $nameProduct = $_POST['nameProduct'];
  $priceProduct = $_POST['priceProduct'];
  $imgProduct = $_POST['imgProduct'];
  $imgAlt = $_POST['imgAlt'];
  $descriptionProduct = $_POST['descriptionProduct'];
  $numberOfItems = $_POST['numberOfItems'];
  $productType = $_POST['productType'];
  $productId = $_GET['id'];
  updateItem($conn, $nameProduct ,$priceProduct, $imgProduct, $imgAlt, $descriptionProduct, $numberOfItems, $productType, $productId);
  header("location: ../shop.php?admin&success=adminItemEdited");
  exit();
}

// Odebere z DB, pokud bylo stisknuto tlačítko Odebrat
if (isset($_POST['adminRemove'])) {
  removeItem();
  $productId = $_GET['id'];
  $sql = "DELETE FROM products WHERE idProduct = $productId;";
  $result = mysqli_query($conn,$sql);
  header('location: ../shop.php?admin&success=adminItemRemoved');
  exit();
}

if (isset($_POST['adminEdit'])) {
  $id = $_GET['id'];
  header('location: ../adminform.php?admin&adminEdit&id='.$id);
  exit();
}