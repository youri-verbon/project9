<?php
session_start();
require_once "config.php";
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

}
else
header("location: index.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="rivor-icon.jpg" type="imgae/x-icon" >
        <hr class="line">
    </head>
    <body>

<div style="margin-top: 10px;" class="container">
        <a href="index.php"><button class="btn btn-success">Home</button></a>
        <a href="gasten.php"><button class="btn btn-primary">Gast Registreren</button></a>
        <a href="logout.php"><button class="btn btn-danger">Uitloggen</button></a>
</div>

        <h1>ROC Rivor</h1><br>
<div class="container-lg">
    <div class="row">
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/ROC_Diploma_Route-1.c202dd06.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Bachstraat, Tiel (hoofdlocatie)</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary">Check aanwezigen</button></a>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/ROC_Diploma_Route-1.963ce4db.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Beethovenstraat, Tiel</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/pand_atotechniek_2.818667c1.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Franklinstraat, Tiel</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/IMG_0073-berwerkt.60a470d9.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Gijsbert Stoutweg, Tiel</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/Rivor_dg_5_-196.8a0bc8ef.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Voor de Kijkuit, Tiel</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/ROC_Diploma_Route-3.fc46807b.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Oudenhof, Geldermalsen</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-4 col-xs-4">
            <div class="card">
                <img src="https://www.rocrivor.nl/media/images/ROC_Dag_6_2.2e16d0ba.fill-360x240.jpegquality-80.jpg" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title">Poppenbouwing, Geldermalsen</h5>
                <p class="card-text"></p>
                <a href="bachstraat.php"><button class="btn btn-primary" disabled>Check aanwezigen</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>