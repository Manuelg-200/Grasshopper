<?php 
    session_start(); 
    $_SESSION = array(); 
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Homepage</title>
        <link rel="stylesheet" type="text/css" href="indexStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
       <?php include("header.php"); 
       include 'DatabaseUtils/connect.php';
       if($DBerror) { ?>
            <div class="ProductSlider">
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
            </div>  <?php } else {
                include("homepageFetch.php"); ?>

       <!-- Categorie/Campionati -->
        <div class="ProductSlider">
            <h1>Campionati</h1>
            <div class="ProductContainer">
                <img src="images/1.jpg" alt="1"/>
                <h2>Maglia Home</h2>
                <p>€50</p>
            </div>
        </div>

        <div class="ProductSlider">
            <h1>Nuovi Arrivi</h1>
            <div class="ProductContainer">
                <img src="images/2.jpg" alt="2"/>
                <h2>Maglia Away</h2>
                <p>€50</p>
            </div>
        </div>

        <div class="ProductSlider">
            <h1>Offerte</h1>
            <div class="ProductContainer">
                <img src="images/3.jpg" alt="3"/>
                <h2>Maglia Third</h2>
                <p>€50</p>
            </div>
        </div>

        <div class="ProductSlider">
            <h1>Pezzi unici</h1>
            <div class="ProductContainer">
                <img src="images/4.jpg" alt="4"/>
                <h2>Sciarpa</h2>
                <p>€20</p>
            </div>
        </div>
        <?php } ?>
    </body>
</html>