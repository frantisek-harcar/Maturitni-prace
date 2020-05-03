<?php
// Zkontroluje jestli je stisknut submit
if (isset($_POST['signup-submit'])) {
	require 'db.inc.php';

	// Data z formuláře
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$pwd = $_POST['pwd'];
	$pwdRepeat = $_POST['repeat-pwd'];

	// Zkontroluje prázná políčka
	if (empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
		header("location: ../signup.php?signup=emptyfields&uid=".$username."&mail=".$email);
		
	}

	// Zkontroluje jestli je už. jména platné
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("location: ../signup.php?signup=invaliduid&mail=".$email);
		
	}

	// Zkontroluje jestli se hesla rovnají
	elseif ($pwd !== $pwdRepeat) {
		header("location: ../signup.php?signup=passwordcheck&uid=".$username."&mail=".$email);
		
	}
	
	//Zkontroluje, jestli je email v databazi
	/*elseif (!empty($email)) {
		$sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?error=sqlerror");
			
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("location: ../signup.php?error=mailtaken&uid=".$username);
				
			}
		}
	}*/
	// Zkontroluje jestli je uživatel v databázi
	else {
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?signup=sqlerror");
			
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("location: ../signup.php?signup=usertaken&mail=".$email);
				
			} 
			// Zaregistruje uživatele
			else {
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../signup.php?signup=sqlerror");
					
				} else {
				// Zahashuje heslo
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

				mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
				mysqli_stmt_execute($stmt);
				header("location: ../signup.php?signup=success");
				
				}
			}	
		}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	}
}else {
	header("location: ../signup.php");
	exit();
}