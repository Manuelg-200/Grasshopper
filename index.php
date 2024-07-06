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
        <div class="ProductsContainer">
            <span><h1 class="CategoryTitle">Campionati</h1></span>
            <div class="ProductSlider">
            <?php for($i = 0; $i < $leagues_number; $i++) { ?>
                <div class="Product">
                    <a href="">
                        <img class="LeagueLogo" src="<?php echo $leagues[$i]->logoPath; ?>" alt="Logo <?php echo $leagues[$i]->name; ?>"/>
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>

        <!-- Prodotti più venduti -->
        <div class="ProductsContainer">
            <span><h1 class="CategoryTitle">I più venduti</h1></span>
            <div class="ProductSlider">
            <?php for($i = 0; $i < $best_selling_number; $i++) { ?>
                <figure class="Product">
                    <a href="">
                        <img class="StadiumImage" src="<?php echo $best_selling[$i]->image_path; ?>" alt="Foto <?php echo $best_selling[$i]->Stadium; ?>"/>
                    </a>
                    <figcaption>
                        <strong><?php echo $best_selling[$i]->game; ?></strong>
                        <span><?php echo date('d/m/Y', strtotime($best_selling[$i]->date)); ?></span></br>
                        <data><?php echo $best_selling[$i]->price; ?>€</data>
                    </figcaption>
            </figure>
            <?php } ?>
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