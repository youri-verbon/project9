<?php
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $timestamp = date("Y-m-d H:i:s");
  $sql = "INSERT INTO `guests` (`firstname`, `lastname`, `email`, `phone`, `covid`, `timestamp`, `time_left`) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['emailaddress']."','".$_POST['phone']."','".$_POST['checkcovid']."','$timestamp','')";
  mysqli_query($link,$sql);

  $naam = $_POST['firstname'];
  $last_id = $link->insert_id;
  $last_id = strval($last_id);
  $to_email = $_POST['emailaddress'];
  $subject = "Druk op de knop of af te melden";
  $body = "Beste $naam," . "<br><br>" . " Uw bezoek aan het Roc Rivor staat geregistreerd." . "<br>" . "Wij verzoeken u vriendelijk af te melden bij vertrek. Alvast bedankt." . "<br><br>" .
            "<html>
            <head>
                <title>Druk op de knop om af te melden</title>
            </head>
            <body>
            <a style=\"font-size: 24px;\" href=\"http://localhost/project9/afmelden.php?id=$last_id\">Klik hier om af te melden</a>
            </body>"
             . "<br><br>" . "Met vriendelijke groet," . "<br>" . "Naam en achternaam" . "<br>" . "ROC Rivor" . "<br><br>" . "</html>";
  $headers = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
  $headers .= "From: registreerrocrivor@gmail.com" . "\r\n";
  $headers .= "Reply-To: registreerrocrivor@gmail.com" . "\r\n"; 
  $headers .= "X-Priority: 3\r\n";

  $headers .= 'X-Mailer: PHP/' . phpversion();

  if (mail($to_email, $subject, $body, $headers)) {
      echo "Email successfully sent to $to_email...";
  } else {
      echo "Email sending failed...";
  }

  header('location: index.php');
  }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        <hr class="line">
    </head>
    <body>
        <h1>Gasten registratie</h1><br>
        <div class="container-lg container-xs ">
          <form action="" onsubmit="document.getElementById('register').disabled=true
      document.getElementById('register').value='Submitting, please wait...';" method="post">
            <div class="form-row">
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault01">Voornaam</label>
                <input type="text" class="form-control" id="validationDefault01" name="firstname" required>
              </div>
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault02">Achternaam</label>
                <input type="text" class="form-control" id="validationDefault02" name="lastname" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault03">Emailadres</label>
                <input type="email" class="form-control" id="validationDefault03" name="emailaddress" required>
              </div>
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault03">Telefoonnummer</label>
                <input type="number" class="form-control" id="validationDefault04" name="phone" required>
              </div>
            </div>
            <div class="form-group">
              <label for="validationDefault04">Heeft u klachen van Covid-19?</label>
              <select name="checkcovid" class="browser-default custom-select">
                <option selected value="1">Ja</option>
                <option value="2">Nee</option>
            </select>
            </div>
            <button class="btn btn-primary margin-button" id="register" type="submit">Registreren</button> 
          </form>
          <a href="index.php"><button class="btn btn-danger margin-button">Terug</button></a>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
    </script>
      </body>
</html>