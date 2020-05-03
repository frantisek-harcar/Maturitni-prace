<?php
require_once('header.php');
?>
		<!-- video -->
		<div class="showcase-video">
			<div class="video-container">
			<a href='#scroll-down'><div class="scroll-down-btn"><i class="fas fa-chevron-down"></i></div></a>
				<video src="./img/sungate.mp4" autoplay loop muted></video>
			</div>
			
			<?php
			if (isset($_SESSION['userId'])) {
				echo "You are logged in as ", $_SESSION["userUid"];

			} else {
				echo "You are logged out";
			}
			 ?>
		</div>
	</header>
<main>
	<section class="tabs" id="scroll-down">
		<div class="container">
			<div id="tab-1" class="tab-item tab-border">
				<i class="fa fa-bong fa-3x"></i>
				<p>Sunable</p>
			</div>
			<div id="tab-2" class="tab-item">
				<i class="fa fa-star fa-3x"></i>
				<p>Služby</p>
			</div>
			<div id="tab-3" class="tab-item">
				<i class="fa fa-record-vinyl fa-3x"></i>
				<p>Nahrávání</p>
			</div>
		</div>
	</section>

	<section class="tab-content">
		<div class="container">
			<!-- tab content 1 -->
			<div id="tab-1-content" class="tab-content-item show">
				<div class="tab-1-content-inner">
					<div>
						<p class="text-lg">Přečti si o tom, kdo jsme a co děláme.</p>
						<a href="about.php" class="btn btn-lg">O nás</a>
						<p class="text-lg">Podívej se na naše fotky</p>
						<a href="gallery.php" class="btn btn-lg">Fotky</a>
						<p class="text-lg">Zhlédni oficiální video ze Sungate</p>
						<a href="https://www.youtube.com/watch?v=q9sWLIONgU8" target='_blank' class="btn btn-lg">Video Sungate</a>
						<p class="text-lg">Poslechni si naši tvorbu</p>
						<a href="https://open.spotify.com/artist/6l6rkdsjgFcJ1HwKWL8iNz" target='_blank' class="btn btn-lg">Tvorba</a>
					</div>
					<img src="./img/sunable1.jpeg">
				</div>
			</div>
			<!-- tab content 2 -->
			<div id="tab-2-content" class="tab-content-item">
				<div class="tab-2-content-inner">
					<div>
						<p class="text-lg">Staň se DJem s naší pomocí</p>
						<a href="#" class="btn btn-lg">DJing</a>
						<p class="text-lg">Pomůžeme ti natočit Tvůj videoklip</p>
						<a href="#" class="btn btn-lg">Videoklipy</a>
						<p class="text-lg">Vydáme Tvou hudbu na Spotify</p>
						<a href="#" class="btn btn-lg">Distribuce</a>
						<p class="text-lg">Vytvoříme beat přesně pro Tebe</p>
						<a href="#" class="btn btn-lg">Beaty</a>
					</div>
					<img src="./img/sunable2.jpeg">
				</div>
			</div>
			<!--  tab content 3 -->
			<div id="tab-3-content" class="tab-content-item">
				<div class="text-center">
					<p class="text-lg">Přijď nahrávat k nám do studia</p>
					<a href="#" class="btn btn-lg">Studio time</a>
				</div>

				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Basic</th>
							<th>Standard</th>
							<th>Premium</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Jednorázová platba</td>
							<td>499 Kč</td>
							<td>999 Kč</td>
							<td>1499 Kč</td>
						</tr>
						<tr>
							<td>Čas ve studiu</td>
							<td>1 hod</td>
							<td>2 hod</td>
							<td>4 hod</td>
						</tr>
						<tr>
							<td>Nahrávání</td>
							<td><i class="fa fa-check"></i></td>
							<td><i class="fa fa-check"></i></td>
							<td><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>Mix/Master</td>
							<td><i class="fa fa-times"></i></td>
							<td><i class="fa fa-check"></i></td>
							<td><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>Beat</td>
							<td><i class="fa fa-times"></td>
							<td><i class="fa fa-times"></td>
							<td><i class="fa fa-check"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
	</section>
</main>
</body>
<?php 

require "footer.html";

?>
	<script type="text/javascript" src="js/main.js"></script>

</html>