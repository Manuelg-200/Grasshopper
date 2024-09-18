<?php
    session_start();

    $submitted = isset($_POST["search"]) ? $_POST["search"] : $_GET["category"];
    $remove = isset($_GET["remove"]) ? $_GET["remove"] : false;
    $searchValue = strtolower(trim($submitted));

    function checkCart($item, $cartItems) {
        // Cookie was parsed in the header file already
        return in_array($item, $cartItems);
    }

    function search($value, $conn) {
        $value = "%".$value."%";
        $stmt = $conn->prepare("SELECT * FROM products, stadiums WHERE stadium=name AND(
                                game LIKE ? OR stadium LIKE ? OR description LIKE ? OR name LIKE ? OR league LIKE ?)");
        $stmt->bind_param("sssss", $value, $value, $value, $value, $value);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $search_results = array();
        while($row = $result->fetch_object()) {
            array_push($search_results, $row);
        }
        return $search_results;
    }
?>

<DOCTYPE html>
<html lang="IT">
    <head>
        <Title>Risultati ricerca per "<?php echo $searchValue; ?>"</Title>
        <link rel="stylesheet" type="text/css" href="indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="shop/shopStyle.css"/>
        <script src="shop/shopCartScript.js"></script>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php 
            include("header.php");
            include("utils/connect.php");
            if($DBerror) { ?>
                <div class="ProductSlider">
                    <h1>Errore!</h1>
                    <p>Impossibile connettersi al server</p>
                    <p>Per favore riprova più tardi</p>
                </div>
            <?php } else { 
                $result = search($searchValue, $conn); 
                $conn->close() ?>
                <div class="ProductsContainer">
                    <h1>Risultati ricerca per "<?php echo $searchValue; ?>"</h1>
                    <?php if(count($result) == 0) { ?>
                        <p class="NothingFoundText">Nessun risultato trovato</p>
                    <?php } else { ?>
                        <div class="SearchResults">
                            <?php for($i = 0; $i < count($result); $i++) { ?>
                                <figure class="Product">
                                    <a href="">
                                        <img class="StadiumImage" src="/Grasshopper/<?php echo $result[$i]->image_path; ?>" alt="Foto <?php echo $result[$i]->stadium; ?>"/>
                                    </a>
                                    <figcaption>
                                        <strong><?php echo $result[$i]->game; ?></strong>
                                        <span><?php echo date('d/m/Y', strtotime($result[$i]->date)); ?></span></br>
                                        <?php if($result[$i]->discount != null) {
                                            $discountAmount = $result[$i]->price * ($result[$i]->discount / 100); ?>
                                            <del><?php echo $result[$i]->price; ?>€</del><strong><?php echo number_format($result[$i]->price - $discountAmount, 2, '.', '') ?>€</strong>
                                        <?php } else { ?>
                                            <data><?php echo $result[$i]->price; ?>€</strong>
                                        <?php }
                                        if($remove == "true") { ?>
                                            <a href="/admin/remove.php?game=<?php echo $result[$i]->game; ?>"><button class="removeButton" id="<?php echo $result[$i]->game ?>">Rimuovi</button></a>
                                        <?php } else {
                                            if(!checkCart($result[$i]->game, $cartItems)) { ?>
                                                <span><i class="fa-solid fa-cart-shopping shoppingCart" aria-label="Aggiungi al carrello" id="<?php echo $result[$i]->game ?>"></i></span>
                                            <?php } else { ?>
                                                <span><i class="fa-solid fa-check shoppingCart" style="color: green;" aria-label="Rimuovi dal carrello" id="<?php echo $result[$i]->game ?>"></i></span>
                                            <?php }
                                        } ?>
                                    </figcaption>
                                </figure>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
        <?php } ?>  
    </body>
</html>