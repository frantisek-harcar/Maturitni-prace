<?php


function getTotalCount() {
	$cart = $_SESSION['cart'];
	$totalCount = 0;
	// Celkový počet produktů v košíku
	foreach ($cart as $key => $cartItem) {
		// Pokud produkt nemá "quantity", přičte 1
		if (!isset($cartItem['quantity'])) {
			$totalCount += 1;
			// Pokud má quantity
		} else {
			$totalCount += (int) $cartItem['quantity'];
		}
	}

	return $totalCount;
}

// Celkové množství pro jeden produkt
function getTotalCountForProduct($productId) {
	$cart = $_SESSION['cart'];
	foreach ($cart as $key => $cartItem) {
		// Pokud se id položky se nerovná tomu, které chceme změnit
		if ( $cartItem['productId'] != $productId) {
			continue;
		}
		// Pokud item nemá index quantity, je jen jeden
		if (!isset($cartItem['quantity'])) {
			return 1;
		}
		// Vrátí počet kusů
		return $cartItem['quantity'];
	}
	// V případě erroru
	return 0;
}
