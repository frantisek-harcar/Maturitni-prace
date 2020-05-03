<?php
if (isset($_POST['uploadFile'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];

  // Rozdělí název souboru podle tečky
  $fileSplit = explode('.', $fileName);
  // Získá koncovku
  $fileExt = strtolower(end($fileSplit));

  $allowed = array('jpg','jpeg','png');
// Zkontroluje koncovku, errory a velikost souboru
  if (in_array($fileExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileDestination = '../products/'.$fileName;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("location: ../adminform.php?adminAdd&success=fileUploaded");
        exit();
      } else {
        header("location: ../adminform.php?adminAdd&error=fileSize");
        exit();
      }
    } else {
      header("location: ../adminform.php?adminAdd&error=Error");
      exit();
    }
  } else {
    header("location: ../adminform.php?adminAdd&error=wrongExt");
    exit();
  }
}