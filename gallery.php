<?php
require_once('./header.php');
require_once('./includes/db.inc.php');
require_once('./includes/component.inc.php');
?>
<body class="white">
  <div class="container">
  <section class="header-tab">
    <div class="content">
      <h1>Sunable Galerie</h1>
      <p>Zde najdeš všechny fotky týkající se Sunablu<br>od soukromých párty až po naše akce!</p>
    </div>
    <!-- Filtry nav -->
    <nav>
      <a href="gallery.php">Všechny fotky</a> |
      <a href="gallery.php?filter=personal">Osobní</a> |
      <a href="gallery.php?filter=event">Akce</a>
    </nav>
    <hr>
  </section>
  <section class="gallery-main">
    <div class="row justify-content-md-center">
      <?php 
      // filtry
      if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        // Osobní
        if ($filter == "personal") {
          $sql = "SELECT * FROM photos WHERE sectionPhoto = 'personal'";
          $result = mysqli_query($conn,$sql);
          if (mysqli_num_rows($result) > 0) {
            printPhoto($result);
          }
        }
        // Akce
        elseif ($filter == "event") {
          $sql = "SELECT * FROM photos WHERE sectionPhoto = 'event'";
          $result = mysqli_query($conn,$sql);
          if (mysqli_num_rows($result) > 0) {
            printPhoto($result);
          }
        }
      } else {
        //Výpis všech fotek
        $result = getPhoto($conn);
        printPhoto($result);
      }
      ?>
    <!-- <div class="row justify-content-md-center">
      <div class="col col-lg-2 mx-4">
        <div class="card mx-auto" style="width: 18rem;">
          <img class="card-img-top" src="products/cap2.png" alt="Cap">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col col-lg-2 mx-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="products/cap2.png" alt="Cap">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col col-lg-2 mx-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="products/cap2.png" alt="Cap">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
    </div> -->
  </section>
  
</body>
<?php
  require_once('footer.html');
?>