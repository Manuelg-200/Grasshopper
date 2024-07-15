<?php 
    session_start();
    include '../DatabaseUtils/rememberLogin.php';
    if(!isset($_SESSION["LoggedIn"])) {
        header("Location: ../LoginForm.php");
        exit;
    }

    function fetchFromDatabase($cartItems, $conn) {
        $stmt =  $conn->prepare("SELECT * FROM products, stadiums WHERE game = ? AND stadium = name");
        $result = array();
        for($i = 0; $i < count($cartItems); $i++) {
            $stmt->bind_param('s', $cartItems[$i]);
            $stmt->execute();
            $result[$i] = $stmt->get_result()->fetch_object();
        }
        $stmt->close();
        return $result;
    }

    function calculateTotal($items) {
        $total = 0;
        for($i = 0; $i < count($items); $i++) {
            if($items[$i]->discount != null) {
                $discountAmount = $items[$i]->price * ($items[$i]->discount / 100);
                $total += $items[$i]->price - $discountAmount;
            } else {
                $total += $items[$i]->price;
            }
        }
        return $total;
    }
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Carrello</title>
        <link rel="stylesheet" type="text/css" href="../styles/indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="shopStyle.css"/>
        <script src="cartScript.js"></script>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("../header.php"); 
        include '../DatabaseUtils/connect.php';
        if($DBerror) { ?>
            <div class="ProductSlider">
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
            </div>
        <?php exit; }
        $result = fetchFromDatabase($cartItems, $conn); ?>
        <div class="cart">
            <h1>Carrello</h1>
            <!-- Cart items parsed from the cookie in the header file --->
            <?php if(count($result) == 0) { ?>
                <p class="NothingFoundText">Il carrello è vuoto</p>
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
                            <?php } ?>
                        </figcaption>
                        <button class="removeButton" id="<?php echo $result[$i]->game ?>">Rimuovi</button>
                    </figure>
                <?php } ?>
                </div>
                <?php $total = calculateTotal($result); ?>
                <p class="Total">Totale: <strong><?php echo number_format($total, 2, '.', ''); ?>€</strong></p>
                <button class="paymentButton">Procedi al pagamento</button>
            <?php } ?>
        </div>
    </body>
</html>