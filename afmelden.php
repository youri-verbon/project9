<?php
require_once "config.php";
$id = $_GET['id'];

$time_left = date("Y-m-d H:i:s");

$sql = "UPDATE `guests` SET `time_left`='$time_left' WHERE `id_guests` = $id AND `time_left` = ''";
mysqli_query($link,$sql);

$affected_rows = mysqli_affected_rows($link);

if($affected_rows == 0){
    echo"<h1>Helaas, er is iets mis gegaan. Probeer het nogmaals.</h1>";
    die;
} else{
 header("location: bedankt.php");
}
?>