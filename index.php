<?php
session_start();
include_once("config.php");

// Ellenőrzi, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Ha a felhasználó nincs bejelentkezve, átirányítja a bejelentkezési oldalra
    header("location: login.php");
    exit;
}

// Ellenőrzi, hogy a felhasználónak a neve elérhető-e a munkamenetben
if (isset($_SESSION['felhasznalo_nev'])) {
    $felhasznalo_nev = $_SESSION['felhasznalo_nev'];
} else {
    // Ha a felhasználónak a neve nem elérhető, átirányítja a bejelentkezési oldalra
    header('Location: login.php');
    exit; 
}


// Ellenőrzi, hogy a kérés metódusa POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrzi, hogy a form már el lett-e küldve
    if (!isset($_SESSION['form_submitted'])) {
        // Szűri az e-mail címet
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        // SQL lekérdezés előkészítése az e-mail cím hozzáadásához a hírlevél listához
        $sql = "INSERT INTO hirlevel (email) VALUES ('$email')";

        // Végrehajtja az SQL lekérdezést
        if ($conn->query($sql) === TRUE) {
            echo "Feliratkozás sikeres.";
        } else {
            echo "Hiba történt: " . $conn->error;
        }

        // Megjelöli, hogy a form már el lett küldve
        $_SESSION['form_submitted'] = true;
    } else {
    }
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

  <main>
    <div class="container">
      <div class="main_part">
        <div class="col-lg-8">
          <div class="hero-text">
            <h1>
              <?php
              echo "Szia, " . htmlspecialchars($felhasznalo_nev) . "!";
              ?>
            </h1>
            <p>
              <em>Shiba Mobile</em>
            </p>
            <p>Stílusban és védelemben egyedülálló.</p>
            <a href="products.php">
              <button>Rendelj most</button>
            </a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="canvas_container">
            <canvas id="canvas3d"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>

  <section class="newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Maradj Naprakész!</h2>
          <p>Iratkozz fel a hírlevelünkre, hogy minden újdonságról értesülj a Shiba Mobile-tól.</p>
          <form method="post" action="">
            <div class="input-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email címed:" required>
              <button type="submit" class="button">Feliratkozás</button>
            </div>
          </form>
          <?php
          use PHPMailer\PHPMailer\PHPMailer;

          require "src/SMTP.php";
          require "src/Exception.php";
          require "src/PHPMailer.php";
          if (isset($_POST["email"])) {


            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.mailersend.net';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->CharSet = 'UTF-8';

            $mail->Username = 'MS_LN0z2Z@trial-v69oxl5yy5x4785k.mlsender.net';
            $mail->Password = '7sHdX7kt69zcwoNp';

            $mail->From = 'MS_LN0z2Z@trial-v69oxl5yy5x4785k.mlsender.net';
            $mail->FromName = 'Shiba Mobile';
            $mail->AddAddress('balogh.balint1022@gmail.com');
            $mail->addReplyTo($_POST['email']);

            $mail->IsHTML(true);

            $mail->Subject = 'Kedves Shiba Mobile felhasználó!';
            $mail->Body = '<p>Köszönjük feliratkozásod hírlevelünkre!</p>';
            if (!$mail->Send()) {
              echo 'A levél küldése sikertelen!';
              echo 'Hiba: ' . $mail->ErrorInfo;
              exit;
            }
            echo 'A levelet sikeresen kiküldtük.';
          }
          ?>
        </div>
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
    </div>
    <div class="text-center p-3">
      &copy; Shiba Mobile
    </div>
  </footer>
  <script type="module" src="js/case.js"></script>
  <script src="js/script.js"></script>
</body>

</html>