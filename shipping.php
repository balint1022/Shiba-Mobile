<?php
session_start();
require_once ("config.php");

if (!isset ($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/shipping.css">
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

  <h2 class="display-4 text-center typewriter">Szállítás</h2>
  <br>
  <br>
  <div class="container">
    <aside>
      <p class="subhead"><span id="first_letter">L</span>orem ipsum dolor sit amet consectetur, adipisicing elit.
        Similique quod architecto officiis obcaecati alias,
        esse sunt. Iste, sapiente eum possimus aliquam odio magnam quibusdam commodi ex similique unde omnis ipsam.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse atque impedit, iste commodi vero officia dolorum
        quas laboriosam veritatis excepturi nesciunt explicabo blanditiis temporibus rem eaque exercitationem! </p>
      <img src="https://cdn.dribbble.com/users/1017716/screenshots/14404808/media/e731fb54b71c807a67e031e8bd9cd48e.gif"
        alt="" id="shipping_gif">

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Lorem</th>
            <th scope="col">Ipsum</th>
            <th scope="col">Dolor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>sit</td>
            <td>amet</td>
            <td>consectetur</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>adipiscing</td>
            <td>elit</td>
            <td>proin</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>faucibus</td>
            <td>spaien</td>
            <td>gravida</td>
          </tr>
        </tbody>
      </table>
    </aside>

    <p>
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo quidem inventore fuga ipsa corporis eum aperiam
      voluptate sapiente at, odit sunt illum eaque accusamus porro vero neque! Dolor, necessitatibus nemo.
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi consequatur debitis magni alias assumenda animi
      laboriosam optio voluptates libero.
    </p>
    <br>
    <p>
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit ipsum officia, blanditiis, distinctio voluptatum
      dolores quidem obcaecati esse nesciunt soluta cupiditate sed earum exercitationem ab deserunt quod, placeat
      facilis dicta.
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta odit enim assumenda provident animi sed blanditiis
      eveniet alias nisi! Debitis, harum expedita. Veniam laboriosam impedit delectus dolorum architecto earum magni!
    </p>


    <div class="row">
      <div class="card ">
        <div class="card-box">
          <div class="title">
            <h1>01</h1>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </p>

        </div>
      </div>
      <div class="card ">
        <div class="card-box">
          <div class="title">
            <h1>02</h1>
          </div>
          <p>
            Proin faucibus sapien ac lectus mollis gravida. In accumsan magna non dignissim feugiat. Nam ut porta odio,
            id fringilla metus.
          </p>

        </div>
      </div>
      <div class="card ">
        <div class="card-box">
          <div class="title">
            <h1>03</h1>
          </div>
          <p>
            Donec interdum nulla quis urna feugiat, eget semper nisl lobortis.
          </p>

        </div>
      </div>
    </div>
  </div>

  <script src="js/script.js"></script>
</body>

</html>