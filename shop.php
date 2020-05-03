<?php 
	require_once('./includes/component.inc.php');
	require_once('./includes/db.inc.php');
	require_once('./includes/admin.inc.php');
	require("./header.php");
?>
	<title>Sunable - Shop</title>
	<body class="white">
		<section >
			<div class="container text-center py-2">
						<?php
						// Menu Speciální filtry
							if ($_SESSION['admin'] == 1 & isset($_GET['admin'])) {
								// Pokud je uživatel ve správě obchodu, přidá tlačítko pro novou položku a upraví odkazy
								echo("
									<nav class='sort'>
										<a href='shop.php?admin&filter=trendy' class='filter-special'>Trendy</a>
										|
										<a href='shop.php?admin&filter=newest' class='filter-special'>Nejnovější</a>
										<hr>
										<form action='./adminform.php?admin method='post'>
											<button type='submit' class='btnSuccess btn-success my-3 mx-1 p-1 py-2' name='adminAdd'>Přidat novou položku</a>
										</form>
									</nav>
								");
							}else {
								echo("
								<nav class='sort'>
									<a href='shop.php?filter=trendy' class='filter-special'>Trendy</a>
									|
									<a href='shop.php?filter=newest' class='filter-special'>Nejnovější</a>
									<hr>
								</nav>
								");
							}
						?>
						<div class="browse"> 
						<?php
							//Zprávy pro uživatele
							if(isset($_GET['error'])){
								$error=$_GET['error'];
								if ($error == 'itemInCart') {
									echo ("<p class='error'>Položka už je v košíku!</p>");
								}
							}
							elseif (isset($_GET['success'])) {
								$success = $_GET['success'];
								if ($success == 'itemAdded') {
									echo ("<p class='success'>Položka přidána!</p>");
								}
								elseif ($success == 'ordercomplete'){
								echo ("<p class='success'>Objednávka přijata!</p>");
								}
								elseif ($success == 'adminItemRemoved'){
								echo ("<p class='success'>Položka byla odebrána!</p>");
								}
								elseif ($success == 'adminItemEdited'){
									echo ("<p class='success'>Položka byla upravena!</p>");
								}
							}
							elseif (isset($_GET['filter'])) {
								$filterMessage = $_GET['filter'];
								if ($filterMessage == 'hoodies') {
									echo ("<p class='text-lg'>Hoodies</p>");
								}
								elseif ($filterMessage == 'hats') {
									echo ("<p class='text-lg'>Hats</p>");
								}
								elseif ($filterMessage == 'tshirts') {
									echo ("<p class='text-lg'>T-shirts</p>");
								}
								elseif ($filterMessage == 'shoes') {
									echo ("<p class='text-lg'>Shoes</p>");
								}
								elseif ($filterMessage == 'trendy') {
									echo ("<p class='text-lg'>Trendy</p>");
								}
								elseif ($filterMessage == 'newest') {
									echo ("<p class='text-lg'>Nejnovější</p>");
								}
							}
						?>
						<div class="row text-center ">
							<!-- Menu Filtry -->
							<div class="col-2 py-5">
								<?php
								// Upraví filtry podle toho jestli je uživatel v administraci, nebo ne
									if ($_SESSION['admin'] == 1 & isset($_GET['admin'])) {
										echo("
											<div class='card shadow bg-dark'>
												<div class='card-body'>
													<h6 class='card-title'>Filters</h6>
													<a href='shop.php?admin' class='filter'>All products</a> <br />
													<a href='shop.php?admin&filter=hoodies' class='filter'>Hoodies</a> <br />
													<a href='shop.php?admin&filter=hats' class='filter'>Hats</a> <br />
													<a href='shop.php?admin&filter=tshirts' class='filter'>T-shirts</a> <br />
													<a href='shop.php?admin&filter=shoes' class='filter'>Shoes</a>
												</div>
											</div>
											<form action='./administration.php'>
												<button type='submit' class='btn my-3 mx-auto' name='adminBack'>Zpět do administrace</a>
											</form>
										");
									} else {
										echo("
											<div class='card shadow bg-dark'>
												<div class='card-body'>
													<h6 class='card-title'>Filters</h6>
													<a href='shop.php' class='filter'>All products</a> <br />
													<a href='shop.php?filter=hoodies' class='filter'>Hoodies</a> <br />
													<a href='shop.php?filter=hats' class='filter'>Hats</a> <br />
													<a href='shop.php?filter=tshirts' class='filter'>T-shirts</a> <br />
													<a href='shop.php?filter=shoes' class='filter'>Shoes</a>
												</div>
											</div>
										");
									}
								?>
							</div>
						<div class="col-10">
						<div class="row text-center py-5">
							<?php 
								//Filtry
								if (isset($_GET['filter'])) {
									$filter = $_GET['filter'];
									// mikiny
									if ($filter == "hoodies") {
										$sql = "SELECT * FROM products WHERE productType = 'hoodie'";
										$result = mysqli_query($conn,$sql);
										if (mysqli_num_rows($result) > 0) {
											printComponent($result);
										}
									}
									// čepice
									elseif($filter == "hats") {
										$sql = "SELECT * FROM products WHERE productType = 'hat'";
										$result = mysqli_query($conn,$sql);
										if (mysqli_num_rows($result) > 0) {
											printComponent($result);
										}
									}
									// trička
									elseif($filter == "tshirts") {
										$sql = "SELECT * FROM products WHERE productType = 'tshirt'";
										$result = mysqli_query($conn,$sql);
										if (mysqli_num_rows($result) > 0) {
											printComponent($result);
										}
									}
									// boty
									elseif($filter == "shoes") {
										$sql = "SELECT * FROM products WHERE productType = 'shoes'";
										$result = mysqli_query($conn,$sql);
										if (mysqli_num_rows($result) > 0) {
											printComponent($result);
										}
									}
									// nejnověší
									elseif($filter == "newest") {
										$result = getDataNewest($conn);
										printComponent($result);
									}
									// trendy
									elseif($filter == "trendy") {
										$result = getDataTrendy($conn);
										printComponent($result);
									}
									// Výpis všech produktů
									else{
										$result = getData($conn);
										printComponent($result);							
									}
								}
								// Výpis produktů z databáze na stránky
								if (!isset($_GET['filter'])) {
								$result = getData($conn);
								printComponent($result);

								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</body>
<?php 

require "footer.html";

?>
<script type="text/javascript" src="js/cart.js"></script>

</html>