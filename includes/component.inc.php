<?php
require_once('db.inc.php');
require_once('cartTotalCount.inc.php');

//Vypíše položku
function printComponent($result){
    while ($row = mysqli_fetch_assoc($result)){
        //Pokud je na skladě vypíše component, pokud ne, vypíše componentOut
        if ($_SESSION['admin'] == 0 || !isset($_GET['admin'])){
            if ($row['numberOfItems']>0){
                component($row['nameProduct'], $row['priceProduct'], $row['imgProduct'], $row['imgAlt'], $row['idProduct']);
            } else {
                componentOut($row['nameProduct'], $row['priceProduct'], $row['imgProduct'], $row['imgAlt'], $row['idProduct']);
            }
        //Pokud je uživatel na stránce administrace a je admin
        }elseif ($_SESSION['admin'] == 1 & isset($_GET['admin'])) {
            componentAdmin($row['nameProduct'], $row['priceProduct'], $row['imgProduct'], $row['imgAlt'], $row['idProduct']);
        } else {
            header("location: ../index.php?error=permission");
            exit();
        }
    }
}


function printPhoto($result){
    while ($row = mysqli_fetch_assoc($result)){
        if ($_SESSION['admin'] == 0 || !isset($_GET['admin'])){
          galleryComponent($row['idPhoto'], $row['imgPhoto'], $row['headerPhoto'], $row['imgAlt'], $row['descriptionPhoto']);
        }
        //Pokud je uživatel na stránce administrace a je admin
        elseif ($_SESSION['admin'] == 1 & isset($_GET['admin'])) {
          galleryComponent($row['idPhoto'], $row['imgPhoto'], $row['headerPhoto'], $row['imgAlt'], $row['descriptionPhoto']);
        } else {
            header("location: ../index.php?error=permission");
            exit();
        }
    }
}
// Šablona pro položku v shopu
function component($productname, $productprice, $productimg, $productalt, $productid){
    $element = "
  <div class='col-md-3 col-sm-6 my-3 my-md-0'>
    <form action='includes/cart.inc.php' method='post'>
        <a class='item-preview' href=item.php?detail&id=$productid>
        <div class='card shadow mb-2'>
          <div>
            <img src='$productimg' alt='$productalt' class='img-fluid card-img-top'>
          </div>
          <div class='card-body'>
            <h6 class='card-title'>$productname</h6>
            <h6>
              <span class='price'>$productprice Kč</span>
            </h6>
            </a>
            <button type='submit' class='btn btn-success my-3' name='add'>Do košíku <i class='fas fa-shopping-cart'></i> </button>
            <input type='hidden' name='productId' value='$productid'>
            </div>
        </div>
	</form>
  </div>
  
              ";
    echo $element;
}
// Šablona pokud položka není na skladě
function componentOut($productname, $productprice, $productimg, $productalt, $productid){
        $element = "
        
        <div class='col-md-3 col-sm-6 my-3 my-md-0'>
            <form action='shop.php' method='post'>
            <a class='item-preview' href=item.php?detail&soldOut&id=$productid>
                <div class='card shadow mb-2'>
                    <div>
                        <img src='$productimg' alt='$productalt' class='img-fluid card-img-top'>
                    </div>
                    <div class='card-body'>
                        <h6 class='card-title'>$productname</h6>
                        <h6>
                            <span class='price'>$productprice Kč</span>
                        </h6>
                        </a>
                        <button type='submit' class='btn btn-danger my-3' name='add' disabled>Vyprodáno <i class='fas fa-shopping-cart'></i> </button>
                        <input type='hidden' name='productId' value='$productid'>
                    </div>
                </div>

            </form>
        </div>
                ";
    echo $element;
}

// Šablona pro administraci
function componentAdmin($productname, $productprice, $productimg, $productalt, $productid){
    if($_SESSION['admin'] == 1){
        $element = "
        
        <div class='col-md-3 col-sm-6 my-3 my-md-0'>
            <form action='includes/admin.inc.php?action=adminremove&id=$productid' method='post'>
                <div class='card shadow mb-2'>
                <div>
                    <img src='$productimg' alt='$productalt' class='img-fluid card-img-top'>
                </div>
                <div class='card-body'>
                    <h6 class='card-title'>$productname</h6>
                    <h6>
                    <span class='price'>$productprice Kč</span>
                    </h6>
                    <button type='submit' class='btnWarning btn-warning my-3 mx-1 p-1' name='adminEdit'>Upravit</a>
                    <input type='hidden' name='productId' value='$productid'>
                    <button type='submit' class='btnDanger btn-danger my-3 mx-1 p-1' name='adminRemove'>Odebrat</a>
                    <input type='hidden' name='productId' value='$productid'>
                    </div>
                </div>
            </form>
        </div>
                    ";
    echo $element;
    } else {
        header("location: ./shop.php?error=permission");
        exit();
    }
}

// Šablona pro položku v košíku
function cartComponent($productname, $productprice, $productimg, $productalt, $productid, $numberofitems){
	$returnTo = $_SERVER['REQUEST_URI'];
	$totalProductCount = getTotalCountForProduct($productid);
    $element = "
        <div class='border rounded my-2'>
            <div class='row bg-white'>
                <div class='col-md-3 pl-0'>
                    <img src=$productimg alt='$productalt' class='img-fluid'>
                </div>
                <div class='col-md-6'>
                    <h5 class='pt-2'>$productname</h5>
                    <small class='text-secondary'>Prodejce: Sunable</small> <br>
                    <small class='text-secondary'>Na skladě: $numberofitems ks</small>
                    <h5 class='pt-2'>$productprice Kč</h5>
                    <form action='./includes/cart.inc.php?action=remove&id=$productid&returnTo=$returnTo' method='post'>
                        <button type='submit' class='btn btn-danger mt-5' name='remove'>Odebrat</button>
                    </form>
                </div>
                <div class='col-md-3 py-5 w-100'>
                    <div class='py-2'>
        				<form action='./includes/cart.inc.php?action=substract&id=$productid&returnTo=$returnTo' method='post'>
                            <button type='submit' id='subtract' class='btn rounded-circle my-2'><i class='fas fa-minus'></i></button>
                        </form>
                        <form action='./includes/cart.inc.php?action=certainNumber&id=$productid&returnTo=$returnTo' method='post'>
                            <input type='number' id='number' name='productCount' value='$totalProductCount' min='1' max='$numberofitems' class='form-control w-50 d-inline'>
                        </form>
						<form action='./includes/cart.inc.php?action=add&id=$productid&returnTo=$returnTo' method='post'>
                            <button type='submit' id='add' class='btn rounded-circle my-2'><i class='fas fa-plus'></i></button>
						</form>
                    </div>
                </div>
            </div>
        </div>
    ";
    echo  $element;

}

// Šablona pro detail položky
function itemComponent($productname, $productprice, $productimg, $productalt, $productid, $numberofitems, $productdescription){
    $element = "
    <div class='row'>
        <div class='col-sm-8 mx-auto my-4'>
            <div class='row'>
                <div class='col-8 col-sm-6 my-2'>
                    '<img src='$productimg' alt='$productalt' class='card shadow img-fluid card-img-top'>'
                </div>
            <div class='col-4 col-sm-6 bg-dark'>
                <h2 class='text-white offset-md-4 my-2 color'>$productname</h2>
                <div>
                    Skladem:
                    <h4>$numberofitems ks</h4>
                </div>
                <div>
                    Popis:
                    <h4>$productdescription</h4>
                </div>
                <div>
                    Cena:
                    <h4>$productprice Kč</h4>
                </div>
        <div class='my-5'>
          <form action='./includes/cart.inc.php' method='post'>
            Velikost: <br>
            <input type='radio' class='mx-2' name='size'value='1' class='hide-input'> XS<br>
            <input type='radio' class='mx-2' name='size'value='2' class='hide-input'> S<br>
            <input type='radio' class='mx-2' name='size'value='3' class='hide-input' checked='checked'> M<br>
            <input type='radio' class='mx-2' name='size'value='4' class='hide-input'> L<br>
            <input type='radio' class='mx-2 mb-4' name='size' value='5' class='hide-input'> XL<br>
            Barva: <br>
            <input type='radio' class='mx-2' name='color' value='6' class='hide-input' checked='checked'> Bílá<br>
            <input type='radio' class='mx-2' name='color' value='7' class='hide-input'> Černá<br>
            <button type='submit' class='btn btn-success my-4 py-3' name='add'>Do košíku <i class='fas fa-shopping-cart'></i> </button>
            <input type='hidden' name='productId' value='$productid'>
          </form>
          <form action='./shop.php'>
			<button type='submit' class='btn my-4 py-3 name='back'>Zpět do obchodu</a>
		  </form>
        </div>
      </div>
    </div>
    </div>
</div>
    ";
    echo $element;
}

// Šablona pro detail položky
function itemComponentOut($productname, $productprice, $productimg, $productalt, $productid, $numberofitems, $productdescription){
    $element = "
    <div class='row'>
  <div class='col-sm-8 mx-auto my-4'>
    <div class='row'>
      <div class='col-8 col-sm-6 my-2'>
        '<img src='$productimg' alt='$productalt' class='card shadow img-fluid card-img-top'>'
      </div>
      <div class='col-4 col-sm-6 bg-dark'>
        <h2 class='text-white offset-md-4 my-2'>$productname</h2>
        <div>
          Skladem:
          <h4>$numberofitems ks</h4>
        </div>
        <div>
          Popis:
          <h4>$productdescription</h4>
        </div>
        <div>
          Cena:
          <h4>$productprice Kč</h4>
        </div>
        <div class='my-5'>
          <form>
            Velikost: <br>
            <input type='radio' class='mx-2' name='size'value='1' class='hide-input'> XS<br>
            <input type='radio' class='mx-2' name='size'value='2' class='hide-input'> S<br>
            <input type='radio' class='mx-2' name='size'value='3' class='hide-input' checked='checked'> M<br>
            <input type='radio' class='mx-2' name='size'value='4' class='hide-input'> L<br>
            <input type='radio' class='mx-2'mb-4' name='size' value='5' class='hide-input'> XL<br>
            Barva: <br>
            <input type='radio' class='mx-2' name='color' value='6' class='hide-input' checked='checked'> Bílá<br>
            <input type='radio' class='mx-2' name='color' value='7' class='hide-input'> Černá<br>
            <button type='submit' class='btn btn-danger my-4 py-3' disabled>Vyprodáno</button>
          </form>
          <form action='./shop.php'>
			<button type='submit' class='btn my-4 py-3 name='back'>Zpět do obchodu</a>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
    ";
    echo $element;
}
//Vypíše fotku v galerii
function galleryComponent($photoId, $photoImg, $photoHeader, $imgAlt, $photoDescription){
    $element = "
    <div class='col-md-3 col-sm-6 my-3 my-md-0'>
        <div class='card mb-2'>
          <a class='photo-preview' href=photo.php?detail&id=$photoId>
            <img class='card-img-top' src='$photoImg' alt='$imgAlt'>
          </a>  
          <div class='card-body'>
          <h6 class='card-title'>$photoHeader</h6>
            <p class='card-text'>$photoDescription</p>
          </div>
        </div>
      </div>
    ";
    echo $element;
}















