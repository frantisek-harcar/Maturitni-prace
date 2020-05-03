<?php

if(!isset($_SESSION))
    {
        session_start();
    }
require_once("dblogin.php");

// Připojení k databázi
$conn = mysqli_connect($servername, $dbusername, $dbpwd, $db);
$conn->set_charset("utf8") or die ("coding");

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

//Galerie
function getPhoto($conn){
	$sql = "SELECT * FROM photos";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		return $result;
	}
}

//Produkty pro obchod
// Vrátí položky z databáze
function getData($conn){
	$sql = "SELECT * FROM products";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		return $result;
	}
}

// Vrátí položky z databáze seřazené od nejnovějších
function getDataNewest($conn){
	$sql = "SELECT * FROM products ORDER BY productDate DESC";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		return $result;
	}
}

// Vrátí položky z databáze seřazené podle počtu prodaných kusů
function getDataTrendy($conn){
	$sql = "SELECT * FROM products ORDER BY sellCount DESC";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
		return $result;
	}
}

// Vloží objednávku do DB
function insertOrder($conn, $orderPerson, $orderMail, $orderPhone, $orderCity, $orderAddress, $orderPostcode){
	$sql = "INSERT INTO orders (orderPerson, orderMail, orderPhone, orderCity, orderAddress, orderPostcode) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "ssssss",$orderPerson, $orderMail, $orderPhone, $orderCity, $orderAddress, $orderPostcode);
	mysqli_stmt_execute($stmt);
}

// Vloží položku do DB
function insertItem($conn, $nameProduct ,$priceProduct, $imgProduct, $imgAlt, $descriptionProduct, $numberOfItems, $productType){
	$sql = "INSERT INTO products (nameProduct, priceProduct, imgProduct, imgAlt, descriptionProduct, numberOfItems, productType, productDate) VALUES (?, ?, ?, ?, ?, ?, ?, now())";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "sssssss", $nameProduct ,$priceProduct, $imgProduct, $imgAlt, $descriptionProduct, $numberOfItems, $productType);
	mysqli_stmt_execute($stmt);
}

// Upraví položku v DB
function updateItem($conn, $nameProduct ,$priceProduct, $imgProduct, $imgAlt, $descriptionProduct, $numberOfItems, $productType, $id){
	$sql = "UPDATE products SET nameProduct = '$nameProduct', priceProduct = '$priceProduct', imgProduct = '$imgProduct', imgAlt = '$imgAlt', descriptionProduct = '$descriptionProduct', numberOfItems = '$numberOfItems', productType = '$productType' WHERE idProduct = '$id'";
	mysqli_query($conn, $sql);


}
