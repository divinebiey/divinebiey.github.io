<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'divine');
define('DB_PASS', 'divine1409');
define('DB_NAME', 'contact');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgName = '';
$msgMessage = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve een naam in te voeren';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        $stmt = $db->exec('INSERT INTO messages (sender, message, added_on) VALUES (\'' . $name . '\',\'' . $message . '\',\'' . (new DateTime())->format('Y-m-d H:i:s') . '\')');

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&display=swap"
    rel="stylesheet">
    <title>Project WTC</title>
</head>
<body>
<header>

</header>

<div class ="navbar">
  <ul>
  <li><a href="index.html">Home</a></li>
  <li><a href="overzichtpagina.html">Missie</a></li>
  <li><a href="detailpagina.html">Klassement</a></li>
  <li><a href="blog.html">Zondag</a></li>
  <li><a href="#">Fietskalender&activiteiten</a></li>
  <li><a href="#">Leden</a></li>
  <li><a href="#">Kampioenen</a></li>
  <li><a href="#">Kledig</a></li>
  <li><a href="#">Clublokaal</a></li>
  <li><a href="#">Geschiedenis</a></li>
  <li><a href="#">Sponsors</a></li>
  <li><a href="#">Reglement</a></li>
  <div class="dropdown">
      <button class="dropbtn">MultiMedia
          <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
          <a href="#">Foto's</a>
          <a href="#">Film</a>
          <a href="#">Verslagen</a>
          <a href="#">Artikelen</a>
      </div>
  </div>
  <div class="dropdown">
      <button class="dropbtn">GPX
          <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
          <a href="https://wtcwetthra.be/gpx-zomer/">GPX Zomer</a>
          <a href="#">GPX Winter</a></li>
          <a href="#">GPX Woensdag</a></li>
          <a href="#">GPX Alternatief</a></li>
          <a href="#">GPX Uitstap</a></li>
          <a href="#">GPX Events</a></li>
          <a href="#">GPX MTB</a></li>
      </div>
  </div>
  <li><a href="contact.php">Contact</a></li>
  </ul>
</div> 
   
	<div class="header-container"></div>
            <h1>Contact me</h1> 
            <p>You have a question or want to work
                <br>together ... get in contact!</p>
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Testform</h1>
        <p class="message">Alle velden zijn verplicht, tenzij anders aangegeven.</p>

        <div>
            <label for="name">Jouw naam</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="input-text"/>
            <span class="message error"><?php echo $msgName; ?></span>
        </div>

        <div>
            <label for="message">Boodschap</label>
            <textarea name="message" id="message" rows="5" cols="40"><?php echo $message; ?></textarea>
            <span class="message error"><?php echo $msgMessage; ?></span>
        </div>

        <input type="submit" id="btnSubmit" name="btnSubmit" value="Verstuur"/>
    </form>

    
    <footer>
        <p>&copy; 2023 WTC. All rights reserved</p>
        <div style="text-align: left;"><span style="font-family: Actor;">
            <iframe width="300" height="175" src="https://www.meteo.be/services/widget/.?postcode=9230&amp;nbDay=2&amp;type=4&amp;lang=nl&amp;bgImageId=0&amp;bgColor=567cd2&amp;scrolChoice=0&amp;colorTempMax=ffffff&amp;colorTempMin=eb0f19" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></span>
        </div>
        <div style="text-align: right; padding: 2rem"><span style="font-family: Actor;">
          <img src="afbeeldingen/VIND ONS FB_1.png" alt="pic">
        </div>
        <div style="text-align: left; margin: 0 2rem"><span style="font-family: Actor;">
            <img src="afbeeldingen/20130121101202logo_ifp_rgb.jpg" alt="pic">
          </div>
      </footer>

            </body>
            </html>