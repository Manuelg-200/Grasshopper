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
                            <?php if($best_selling[$i]->discount != null) { ?>
                                <?php $discountAmount = $best_selling[$i]->price * ($best_selling[$i]->discount / 100); ?>
                                <del><?php echo $best_selling[$i]->price; ?>€</del><strong><?php echo number_format($best_selling[$i]->price - $discountAmount, 2, '.', '') ?>€</strong>
                            <?php } else { ?>
                                <data><?php echo $best_selling[$i]->price; ?>€</data>
                            <?php } ?>
                        </figcaption>
                    </figure>
                <?php } ?>
            </div>
        </div>

        <!-- Prodotti in offerta -->
        <div class="ProductsContainer">
            <span><h1 class="CategoryTitle">Offerte</h1></span>
            <div class="ProductSlider">
                <?php for($i = 0; $i < $discounted_number; $i++) { ?>
                    <figure class="Product">
                        <a href="">
                            <img class="StadiumImage" src="<?php echo $discounted[$i]->image_path; ?>" alt="Foto <?php echo $discounted[$i]->Stadium; ?>"/>
                        </a>
                        <figcaption>
                            <strong><?php echo $discounted[$i]->game; ?></strong>
                            <span><?php echo date('d/m/Y', strtotime($discounted[$i]->date)); ?></span></br>
                            <?php $discountAmount = $discounted[$i]->price * ($discounted[$i]->discount / 100); ?>
                            <del><?php echo $discounted[$i]->price; ?>€</del><strong><?php echo number_format($discounted[$i]->price - $discountAmount, 2, '.', '') ?>€</strong>
                        </figcaption>
                    </figure>
                <?php } ?>
            </div>
        </div>

        <!-- Nuovi prodotti -->
        <div class="ProductsContainer">
            <span><h1 class="CategoryTitle">Nuovi Arrivi</h1></span>
            <div class="ProductSlider">
                <?php for($i = 0; $i < $new_products_number; $i++) { ?>
                    <figure class="Product">
                        <a href="">
                            <img class="StadiumImage" src="<?php echo $new_products[$i]->image_path; ?>" alt="Foto <?php echo $new_products[$i]->Stadium; ?>"/>
                        </a>
                        <figcaption>
                            <strong><?php echo $new_products[$i]->game; ?></strong>
                            <span><?php echo date('d/m/Y', strtotime($new_products[$i]->date)); ?></span></br>
                            <?php if($new_products[$i]->discount != null) { ?>
                                <?php $discountAmount = $new_products[$i]->price * ($new_products[$i]->discount / 100); ?>
                                <del><?php echo $new_products[$i]->price; ?>€</del><strong><?php echo number_format($new_products[$i]->price - $discountAmount, 2, '.', '') ?>€</strong>
                            <?php } else { ?>
                                <data><?php echo $new_products[$i]->price; ?>€</data>
                            <?php } ?>
                        </figcaption>
                    </figure>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </body>
</html>