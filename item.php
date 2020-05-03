<?php
  if (!isset($_GET['id'])) {
    header("location: ./shop.php?error=idNotSet");
    exit();
  }
  require_once('header.php');
  require('includes/db.inc.php');
  require('includes/component.inc.php');

  $id = $_GET['id'];
  $sql = "SELECT * FROM products WHERE idProduct = '$id'";
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
?>

<body class="white">
<?php 
  if (isset($_GET['soldOut'])) {
    itemComponentOut($productName, $productPrice, $productImg, $productAlt, $id, $numberOfItems, $productDescription);
  } else {
    itemComponent($productName, $productPrice, $productImg, $productAlt, $id, $numberOfItems, $productDescription);
  }
?>
</body>