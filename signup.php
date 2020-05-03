<?php 
require_once('header.php');
if (isset($_SESSION['userUid'])) {
	header("location: ./index.php?error=alreadyLogged");
	exit();
}
?>
<body class="gradient">
		<div class="showcase-content move-down">
			<div class="loginpage">
			<!-- Přihlašování -->
				<section class="login">
					<h1>Login</h1>
					<form  id="loginform" action="includes/login.inc.php" method="post">
					<?php
					// Vyplní pole se jménem, pokud bylo vyplněno před chybou
					if (isset($_GET['loginuid'])) {
						$loginuid = $_GET['loginuid'];
						echo '<input class="textfield" type="text" name="uidmail" placeholder="Username/E-mail" value="'.$loginuid.'">';
					}
					else {
						echo '<input class="textfield" type="text" name="uidmail" placeholder="Username/E-mail">';
					}
					?>
						<input class="textfield" type="password" name="pwd" placeholder="Password">
						<button  class="btn btn-signup" type="submit" name="login-submit">Login</button>
					</form>
					<?php
					// Pokud nastala chyba
					if (isset($_GET['login'])) {
						$errorCheck = $_GET['login'];
						// Výpis chyby
						if ($errorCheck == "emptyfields") {
							echo '<p class="error">Fill in all fields!</p>';
							
						}
						elseif ($errorCheck == "sqlerror") {
							echo '<p class="error">SQL error!</p>';
							
						}
						elseif ($errorCheck == "wrongpwd") {
							echo '<p class="error">Wrong password!</p>';
							
						}
						elseif ($errorCheck == "nouser") {
							echo '<p class="error">User does\'nt exist</p>';
							
						}
						elseif ($errorCheck == "success") {
							echo "<p class='error' style='color:green;'>Success!</p>";
							
						}
					}
					?>
				</section>

				<!-- Registrace -->
				<section class="signup">
					<h1>Signup</h1>
					<form id="signupform" action="includes/signup.inc.php" method="post">
					<?php

					// Vyplní pole jména, nebo emailu, pokud byly vyplněny před chybou
						if (isset($_GET['uid'])) {
							$uid = $_GET['uid'];
							echo '<input  class="textfield" type="text" name="uid" placeholder="Username" value="'.$uid.'">';
						}
						else {
							echo '<input  class="textfield" type="text" name="uid" placeholder="Username">';
						}

						if (isset($_GET['mail'])) {
							$mail = $_GET['mail'];
							echo '<input  class="textfield" type="text" name="mail" placeholder="E-mail" value="'.$mail.'">';
						}
						else {
							echo '<input  class="textfield" type="email" name="mail" placeholder="E-mail">';
						}
					?>
						<input  class="textfield" type="password" name="pwd" placeholder="Password">
						<input  class="textfield" type="password" name="repeat-pwd" placeholder="Repeat Password">
						<button  class="btn btn-signup" type="submit" name="signup-submit">Signup</button>
					</form>
					<?php
						// Pokud nastala chyba
						if (isset($_GET['signup'])) {
							
							$errorCheck = $_GET['signup'];
							// Chybové zprávy pro uživatele
							if ($errorCheck == "usertaken") {
								echo '<p class="error">User taken!</p>';
								
							}
							elseif ($errorCheck == "invaliduid") {
								echo "<p class='error'>Invalid username!</p>";
								
							}
							elseif ($errorCheck == "emptyfields") {
								echo "<p class='error'>Fill in all fields!</p>";
								
							}
							elseif ($errorCheck == "passwordcheck") {
								echo "<p class='error'>Passwords don\'t match!</p>";
								
							}
							elseif ($errorCheck == "sqlerror") {
								echo "<p class='error'>SQL error</p>";
								
							}
							elseif ($errorCheck == "mailtaken") {
								echo "<p class='error'>Email taken!</p>";
								
							}
							elseif ($errorCheck == "success") {
								echo "<p class='error' style='color:green;'>Success!</p>";
								
							}
							
						}
					?>
				</section>
				
			</div>
		</div>
	</body>

<?php 
require "footer.html";
?>