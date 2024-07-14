<?php
    $submitted = $_POST["search"];
    $searchValue = strtolower(trim($submitted));

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
        <Title>Risultati ricerca per "<?php echo $search; ?>"</Title>
        <link rel="stylesheet" type="text/css" href="styles/indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="shop/shopStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php 
            include("header.php");
            include("DatabaseUtils/connect.php");
            if($DBerror) { ?>
                <div class="ProductSlider">
                    <h1>Errore!</h1>
                    <p>Impossibile connettersi al server</p>
                    <p>Per favore riprova più tardi</p>
                </div>
            <?php } else { 
                $result = search($searchValue, $conn); ?>
                <div class="ProductsContainer">
                    <h1>Risultati ricerca per "<?php echo $searchValue; ?>"</h1>
                    <?php if(count($result) == 0) { ?>
                        <p>Nessun risultato trovato</p>
                    <?php } else {
                        for($i = 0; $i < count($result); $i++) { ?>
                            <figure class="Product">
                                <a href="">
                                    <img class="StadiumImage" src="/Grasshopper/<?php echo $result[$i]->image_path; ?>" alt="Foto <?php echo $result[$i]->stadium; ?>"/>
                                </a>
                                <figcaption>
                                    <strong><?php echo $result[$i]->game; ?></strong>
                                    <span><?php echo date('d/m/Y', strtotime($result[$i]->date)); ?></span>
                                    <?php if($result[$i]->discount != null) {
                                        $discountAmount = $result[$i]->price * ($result[$i]->discount / 100); ?>
                                        <del><?php echo $result[$i]->price; ?>€</del><strong><?php echo number_format($result[$i]->price - $discountAmount, 2, '.', '') ?>€</strong>
                                    <?php } else { ?>
                                        <data><?php echo $result[$i]->price; ?>€</strong>
                                    <?php } ?>
                                </figcaption>
                            </figure>
                        <?php }
                    } ?>
                </div>
        <?php } ?>  
    </body>
</html>