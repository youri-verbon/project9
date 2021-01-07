<?php
session_start();
require_once "config.php";
// if(!isset($_SESSION["loggedin"])) 
//     { 
//         session_start(); 
//     } 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

}
else {
header("location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM `guests` WHERE `id_guests` = '$id'";
$query = mysqli_query($link,$sql) or die(mysqli_error($link));

$rows = array();
$firstname = '';
$lastname = '';
$email = '';
$phone = '';
$covid = '';
while($row = mysqli_fetch_assoc($query)){
    array_push($rows, $row);
  }
  foreach ($rows as $key => $array) {
      $id = $array['id_guests'];  
      $firstname = $array["firstname"];
      $lastname = $array["lastname"];
      $email = $array["email"];
      $phone = $array["phone"];
      $covid = $array["covid"];
  }
  
  ?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        <hr class="line">
        <h1>Gegevens Bijwerken</h1>
    </head>
    <body>
    <div class="container-lg">
    <a href="bachstraat.php"><button class="btn btn-danger">Terug</button></a>
    <br>
    <br>
    </div>
    <div class="container-lg container-xs">
          <form action="" method="post">
            <div class="form-row">
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault01">Voornaam</label>
                <input type="text" class="form-control" id="validationDefault01" value= "<?php echo $firstname; ?>" name="firstname" required>
              </div>
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault02">Achternaam</label>
                <input type="text" class="form-control" id="validationDefault02" value= "<?php echo $lastname; ?>" name="lastname" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault03">Email-adres</label>
                <input type="email" class="form-control" id="validationDefault03" value= "<?php echo $email; ?>" name="emailaddress" required>
              </div>
              <div class="col-lg-6 col-xs-12">
                <label for="validationDefault03">Telefoonnummer</label>
                <input type="number" class="form-control" id="validationDefault04" value= "<?php echo $phone; ?>" name="phone" required>
              </div>
            </div>
            <div class="form-group">
              <label for="validationDefault04">Heeft u klachen van Covid-19?</label>
              <select name="checkcovid" class="browser-default custom-select">
                <option value="1" <?php if ($covid == 1) echo "selected"; ?>>Ja</option>
                <option value="2" <?php if ($covid == 2) echo "selected"; ?>>Nee</option>
            </select>
            </div>
            <input type="submit" class="btn btn-primary button-mobile-size margin-button" name="send_form" value="Wijzigen" />
          </form>
          <form action="" method="post">
          <input type="submit" class="btn btn-danger button-mobile-size margin-button" name="delete_form" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" value="Verwijderen" />
          </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset ($_POST['send_form'])){
$id = $_GET['id'];
$firstname_edit = $_POST['firstname'];
$lastname_edit = $_POST['lastname'];
$email_edit = $_POST['emailaddress'];
$phone_edit = $_POST['phone'];
$covid_edit = (int)$_POST['checkcovid'];
$sql = "UPDATE `guests` SET `firstname`='$firstname_edit', `lastname`='$lastname_edit', `email`='$email_edit', `phone`='$phone_edit', `covid`='$covid_edit' WHERE `id_guests`='$id'";
mysqli_query($link,$sql);
header("location: bachstraat.php");
}

if (isset ($_POST['delete_form'])){
$id = $_GET['id'];
$sql = "DELETE FROM `guests` WHERE `id_guests` = '$id'";
mysqli_query($link,$sql);
header("location: bachstraat.php");

}
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//   $firstname_edit = $_POST['firstname'];
//   $lastname_edit = $_POST['lastname'];
//   $email_edit = $_POST['emailaddress'];
//   $phone_edit = $_POST['phone'];
//   $covid_edit = (int)$_POST['checkcovid'];
//   $sql = "UPDATE `guests` SET `firstname`='$firstname_edit', `lastname`='$lastname_edit', `email`='$email_edit', `phone`='$phone_edit', `covid`='$covid_edit' WHERE `id_guests`='$id'";
//   mysqli_query($link,$sql);
//   } else{

//   }

?>