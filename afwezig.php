<?php
session_start();
require_once "config.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    
}
else{
header("location: index.php");
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        <hr class="line">
        <h1>Registraties</h1><br>
    </head>
    <body>
    <div class="container-lg">
    <a href="index.php"><button class="btn btn-outline-success">Home</button></a>
    <a href="home.php"><button class="btn btn-outline-danger navi-knop">Terug</button></a>
    <input style="margin-top: 50px;" placeholder="Zoek op naam" id="mylist" onkeyup="myFunction()" class='form-control'>
    <a href="bachstraat.php"><button class="btn btn-outline-primary navi-knop">Aanwezig</button></a>
    <br>
    <br>

<table class='table table-striped'>
<tbody class="bigger-font">
    <td scope="col"><p>Voornaam</p></td>
    <td scope="col"><p>Achternaam</p> </td>  
    <td scope="col"><p>Telefoonnummer</p></td>  
    <td scope="col"><p>Tijd</p></td>   
</tbody>
</table>   
</div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("mylist");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
    </body>
</html>
<?php
$sql = "SELECT * FROM `guests` where LENGTH(time_left) > 4";
$query = mysqli_query($link,$sql) or die(mysqli_error($link));

$rows = array();

echo "<div class='container-lg hide'>"; 
echo "<table id='myTable' class='table table-striped'>"; 

while($row = mysqli_fetch_assoc($query)){
    array_push($rows, $row);
  }
  foreach ($rows as $key => $array) {
    $id = $array['id_guests'];
    echo "<tr>";
    echo "<td scope='col'>" . $array["firstname"] . "</td>" . "<td scope='col'>" . $array["lastname"] . "</td>" . "<td scope='col'>" . $array["phone"] . "</td>" . "<td scope='col'>" . $array["timestamp"] . "</td>";
    echo "<td scope='col'>" . "<a href='details.php?id=" . $id . "'" . ">" . "<button class='btn btn-outline-primary knop' type='button' title='Edit'>" . 'Edit' . "</button>" . "</a>" . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "</div>";
?>
