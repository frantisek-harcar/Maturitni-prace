<?php

require_once('db.inc.php');
require_once('cartTotalCount.inc.php');

//Vyprázdní košík
if (isset($_POST['removeAll'])) {
  unset($_SESSION['cart']);
  header("location: ../cart.php?success=cartempty");
  exit();
}
//Odebere položku z košíku
elseif (isset($_POST['remove'])) {
  if ($_GET['action'] == 'remove') {
    foreach ($_SESSION['cart'] as $key => $value){
      if ($value['productId'] == $_GET['id']) {
        unset($_SESSION['cart'][$key]);
        if (count($_SESSION['cart']) < 1) {
          unset($_SESSION['cart']);
        }
        header("location: ../cart.php?success=itemremoved");
        exit();
      }
    }
  }
}

// Přičte kusy v košíku
if (isset($_GET['action']) && $_GET['action'] === 'add') {
	$cart = $_SESSION['cart'];
  $productId = $_GET['id'];
    
	foreach ($cart as $key => $cartItem) {
    // Zaručí správné ID
		if ( $cartItem['productId'] != $productId) {
			continue;
    }
    // Zjistí počet kusů na skladě
    $sql = "SELECT numberOfItems FROM `products` WHERE idProduct = $productId";
    $result = mysqli_query($conn, $sql);
    $numberOfItemsAssoc = mysqli_fetch_assoc($result);
    $numberOfItems = (int)$numberOfItemsAssoc['numberOfItems'];
    // Počet kusů nesmí překročit počet na skladě
    if ($_SESSION['cart'][$key]['quantity'] < $numberOfItems) {
      // Pokud není quantity (1 kus)
      if (!isset($cartItem['quantity'])) {
        $_SESSION['cart'][$key]['quantity'] = 2;
      // Přičte k číslu 1
      } else {
        $_SESSION['cart'][$key]['quantity'] += 1;
      }
    } else {
      break;
    }
    
  }
  // Vrátí zpět odkud přišel
  header("Location: " . $_GET['returnTo']);
  exit();
}

// Odečte kusy v košíku
if (isset($_GET['action']) && $_GET['action'] === 'substract') {
	$cart = $_SESSION['cart'];
	$productId = $_GET['id'];
	foreach ($cart as $key => $cartItem) {
    // Zaručí správné ID
		if ( $cartItem['productId'] != $productId) {
			continue;
    }
    // Pokud není quantity neprovede nic
		if (!isset($cartItem['quantity'])) {
      continue;
      // Odečte 1
		} elseif ($cartItem['quantity'] > 1) {
			$_SESSION['cart'][$key]['quantity'] -= 1;
		}
  }
  // Vrátí zpět odkud přišel
  header("Location: " . $_GET['returnTo']);
  exit();
}

// Zadání množství položek přímo do inputu
if (isset($_GET['action']) && $_GET['action'] === 'certainNumber') {
	$cart = $_SESSION['cart'];
	$productId = $_GET['id'];
	foreach ($cart as $key => $cartItem) {
		if ( $cartItem['productId'] != $productId) {
			continue;
    }
    // Změní číslo na inputu, potřeba potvrdit enterem
		$_SESSION['cart'][$key]['quantity'] = (int) $_POST['productCount'];
  }
  // Vrátí zpět odkud přišel
  header("Location: " . $_GET['returnTo']);
  exit();
}

// Filtry
if (isset($_GET['filter'])) {
  $filter = $_GET['filter'];

}
// Přidá ID položky do košíku pokud existuje, nebo vytvoří nový košík a přidá ID
if (isset($_POST['add'])) {
  if (isset($_SESSION['cart'])) {
    // Vrátí array ze Session s "productId"
    $item_array_id = array_column($_SESSION['cart'], "productId");
    // Pokud se ID nachází v košíku -> error
    if (in_array($_POST['productId'], $item_array_id)) {
      header("location: ../shop.php?error=itemInCart");
      exit();
    } else{
      // Spočítá proměnné v košíku a přidá na poslední pozici novou položku
      $count = count($_SESSION['cart']);
      $item_array = array(
        'productId' => $_POST['productId']
      );
      $_SESSION['cart'][$count] = $item_array;
      // Pokud je nastavený filtr, odkáže na stránku s filtrem
      header("location: ../shop.php?success=itemadded");
      exit();
    }
  } else{
    // Přidá položku do košíku
    $item_array = array(
      'productId' => $_POST['productId']
    );
    // Inicializace košíku
    $_SESSION['cart'][0] = $item_array;
    // Odkáže na stránku s filtrem
    header("location: ../shop.php?success=itemadded");
    exit();
  }
}
