<?php 
    session_start();
    include 'DatabaseUtils/rememberLogin.php';
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <Title>Grasshopper pagina principale, presentazione, vendita prato partite di calcio</Title>
        <link rel="stylesheet" type="text/css" href="styles/indexStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="ContentContainer left">
            <h1>La nuova frontiera del collezionismo sportivo</h1>
            <p>Benvenuto su Grasshopper, il negozio online dove puoi trovare vere e proprie zolle di terreno dagli stadi più importanti,
                toccati dai campioni del calcio mondiale.<p>
            <p>Se sei un appassionato di calcio, non puoi perderti questa occasione unica di portare a casa letteralmente un pezzo di storia!</p>
            <p style="text-align: center;">Trova la zolla perfetta per te:</p>
            <form class="HomepageSearchBarContainer">
                <input type="text" placeholder="Cerca..." class="HomepageSearchBar"></input>
                <button type="submit" class="searchButton"><i class="fa-solid fa-magnifying-glass"></i></Button>
            </form>
        </div>

        <div class="ContentContainer right">
            <h1>I nostri prodotti sono sicuramente autentici, non abbiate dubbi</h1>
            <p>Le zolle di terreno che vendiamo sono state prelevate direttamente dagli stadi, con certificato di autenticità <small>(che non potete vedere)</small></p>
            <p>Per ogni perplessità riguardo la provenienza delle zolle, vi rimandiamo al nostro <a href="">team di avvocati</a></p>
        </div>

        <div class="ContentContainer left">
            <h1>Pezzi unici, di partite davvero speciali</h1>
            <p>Per i collezionisti più esigenti, abbiamo zolle davvero speciali, da finali di Champions League, Mondiali, Europei e molto altro</p>
        </div>

        <div class="ContentContainer right">
            <p style="text-align: center";>Non perdere l'occasione di portare a casa un pezzo di storia!</p>
            <a href="shop/shop.php" style="text-decoration: none;"><button class="shopButton">Visita il negozio</button></a>
        </div>
        <script src="scripts/homepageAnimation.js" type="text/javascript"></script>
    </body>
</html>