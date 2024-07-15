<?php 
    // Parse cart cookie if it exists
    $cartItems = array();
    if(isset($_COOKIE["cart"])) {
        $cartValue = urldecode($_COOKIE["cart"]);
        $cartItems = explode(',', $cartValue);
    }
?>

<!-- Factorization of the header -->
<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Header</title>
        <link rel="stylesheet" type="text/css" href="/Grasshopper/styles/headerStyle.css"/>
        <script src="https://kit.fontawesome.com/4cf75b295a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <header>
            <span><a href="/Grasshopper/index.php"><img src="/Grasshopper/grasshopper_logo.png" alt="Logo raffigurante un grillo" class="Logo"></img></a></span>
            <form action="/Grasshopper/search.php" method="post" class="searchBarContainer">
                <input type="text" name="search" placeholder="Cerca..." class="searchBar"></input>
                <button type="submit" class="searchButton" aria-label="Search"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
            </form>
            <a href="/Grasshopper/shop/cart.php" class="cartLink">
            <?php if(count($cartItems) == 0) {?>
                <i class="fa-solid fa-cart-shopping fa-lg" aria-label="Carrello" id="headerCart"></i>
            <?php } else {?>
                <i class="fa-solid fa-<?php echo count($cartItems); ?> fa-lg" aria-label="Carrello" id="headerCart"></i>
            <?php } ?>
            </a>
        </header>
        <nav>
            <a href="/Grasshopper/index.php"><button class="navBarButton">Home</button></a>
            <a href="/Grasshopper/companyBio.php"><button class="navBarButton">Chi Siamo</button></a>
            <a href="/Grasshopper/shop/shop.php"><button class="navBarButton">Negozio</button></a>
            <?php if(isset($_SESSION["LoggedIn"])) { ?>
                <a href="/Grasshopper/show_profile.php"><button class="navBarButton">Profilo</button></a>
                <span class="accessControlButtonContainer">
                    <a href="/Grasshopper/Logout.php"><button class="navBarButton">Logout</button></a> 
                </span>
            <?php } else { ?>
                <span class="accessControlButtonContainer">
                    <a href="/Grasshopper/LoginForm.php"><button class="navBarButton">Accedi</button></a>
                    <a href="/Grasshopper/SignUpForm.php"><button class="navBarButton">Registrati</button></a>
                </span>
            <?php } ?>
        </nav>
        <script src="/Grasshopper/scripts/searchCheck.js"></script>
    </body>
</html>