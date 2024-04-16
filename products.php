<?php

session_start();

include_once ("config.php");
if (!isset($_SESSION['id'])) {
  header("Location: 404.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Shiba Mobile</title>
</head>

<body>
  <br><br>
  <header class="navigation-header">

    <nav>
      <div class="logo-container navigation-items">
        <img src="img/Logo.png" alt="Shiba Mobile Logo" id="logo"><a href="index.php">Shiba Mobile</a>
      </div>
      <div class="navigation-items" id="navigation-items">
        <a href="products.php">Termékek</a>
        <a href="about.php">Rólunk</a>
        <a href="cart.php">Kosár</a>
        <a href="logout.php">Kijelentkezés</a>
        <div class="hamburger">
          <span id="closeHam">&#x2716;</span>
        </div>
      </div>
      <div class="hamburger">
        <span id="openHam">&#9776;</span>
      </div>
    </nav>
  </header>

  <section class="section all-products" id="products">
    <div class="col-md-12">
      <h1 class="display-4 text-center typewriter">Termékek</h1>
      <p class="text-center lead">Shiba telefonokok</p>
    </div>

    <div class="product-center container">
      <div class="product-item">
        <div class="overlay">
          <a href="productDetails.html" class="product-thumb">
            <img src="img\tok\tok1.jpg" alt="" />
          </a>
          <span class="discount">40%</span>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="productDetails.html">SHIBA TELEFONTOK</a>
          <h4>4.800 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=1" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok2.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>8.000 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=2" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok3.jpg" alt="" />
          </a>
          <span class="discount">20%</span>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>6.400 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=3" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok4.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>8.000 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=4" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok5.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>8.000 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=5" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok6.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>8.000 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=6" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok7.jpg" alt="" />
          </a>
          <span class="discount">20%</span>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>6.400 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=7" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="img\tok\tok8.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>SHIBA TOKOK</span>
          <a href="">SHIBA TELEFONTOK</a>
          <h4>8.000 Ft</h4>
        </div>
        <ul class="icons">
          <li><a href="product_details.php?id=8" target="_blank"><i class="fa">&#xf002;</i></a></li>
        </ul>
      </div>
    </div>
  </section>

  <footer class="text-center text-lg-start text-white">
    <div class="container p-4 pb-0">
      <section class="mb-4 text-center icon">
        <h5>Elérhetőségek:</h5>
        <i class="fa">&#xf09a;</i>
        <i class="fa">&#xf081;</i>
        <i class="fa">&#xf16d;</i>
      </section>
      <div class="text-center p-3">
        &copy; Shiba Mobile
      </div>
  </footer>
  <script type="module" src="js/case.js"></script>
  <script src="js/script.js"></script>
</body>

</html>