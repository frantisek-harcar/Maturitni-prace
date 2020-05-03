<?php
// Pokud byl zmáčknut submit u login formuláře
if (isset($_POST['login-submit'])) {
	require 'db.inc.php';
	$uidmail = $_POST['uidmail'];
	$password = $_POST['pwd'];
	// Pokud jsou prázdná políčka -> error
	if (empty($uidmail) || empty($password)) {
		header("location: ../signup.php?login=emptyfields&loginuid=".$uidmail);
		exit();
	} else {
		// Vybere uživatele podle jména, nebo emailu
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?login=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $uidmail, $uidmail);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			// Kontrola hesla
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($password, $row['pwdUsers']);
				// Heslo se nerovná
				if ($pwdCheck == false) {
					header("location: ../signup.php?login=wrongpwd&loginuid=".$uidmail);
					exit();
				}
				// Heslo se rovná, přihlášení a nastavení proměnných
				else if($pwdCheck == true){
					session_start();
					$_SESSION["userId"] =  $row['idUsers'];
					$_SESSION["userUid"] =  $row['uidUsers'];
					$_SESSION["admin"] = $row['admin'];
					header("location: ../index.php?login=success");
					exit();
				} else {
					header("location: ../signup.php?login=nouser");
					exit();
				}
			} else {
				header("location: ../signup.php?login=nouser");
				exit();
			}
		}
	}

} else {
	header("location: ../index.php");
	exit();
}