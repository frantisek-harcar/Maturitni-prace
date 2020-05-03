<?php
session_start();
require("./header.php");
// Ověři, že je uživatel admin
if ($_SESSION['admin'] < 1) {
	header("location: ./index.php?error=permission");
  exit();
}
?>
<title>Sunable - Administration</title>
<body class="black">
      <!-- menu -->
      <section class="tabs">
		<div class="container">
			<div id="tab-1" class="tab-item tab-border">
      <i class="fa fa-user fa-3x"></i>
				<p>Administrace</p>
			</div>
			<div id="tab-2" class="tab-item">
				<i class="fa fa-music fa-3x"></i>
				<p>Studio</p>
			</div>
			<div id="tab-3" class="tab-item">
				<i class="fa fa-chart-bar fa-3x"></i>
				<p>Statistiky</p>
			</div>
		</div>
  </section>
  <!-- Tabs -->
	<section class="tab-content">
		<div class="container">
			<!--tab content 1 -->
			<div id="tab-1-content" class="tab-content-item show">
				<div class="tab-1-content-inner">
					<div>
						<p class="text-lg">Shop</p>
            <a href="shop.php?admin" class="btn btn-lg">Spravovat</a>
						<p class="text-lg">Správa článků</p>
						<a href="#" class="btn btn-lg">Spravovat</a>
						<p class="text-lg">Správa Objednávek</p>
						<a href="#" class="btn btn-lg">Spravovat</a>
						<p class="text-lg">Správa Uživatelů</p>
						<a href="#" class="btn btn-lg">Spravovat</a>
					</div>
					<img src="./img/sunable1.jpeg">
				</div>
      </div>
      <!-- tab content 2 -->
			<div id="tab-2-content" class="tab-content-item">
				<div class="tab-2-content-inner">
					<div>
						<p class="text-lg">DJ sessions</p>
						<a href="#" class="btn btn-lg">Check</a>
						<p class="text-lg">Videoklipy</p>
						<a href="#" class="btn btn-lg">Check</a>
						<p class="text-lg">Vydávání hudby</p>
						<a href="#" class="btn btn-lg">Check</a>
						<p class="text-lg">Beaty</p>
						<a href="#" class="btn btn-lg">Beaty</a>
					</div>
					<img src="./img/sunable2.jpeg">
				</div>
			</div>
			<!--  tab content 3 -->
			<div id="tab-3-content" class="tab-content-item">
				<div class="text-center">
					<p class="text-lg">Statistiky...</p>
				</div>
			</div>
	</section>
</body>
<?php
require("./footer.html");
?>
<script type="text/javascript" src="js/main.js"></script>