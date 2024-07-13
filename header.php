<!-- Factorization of the header -->
<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Header</title>
        <link rel="stylesheet" type="text/css" href="/Grasshopper/headerStyle.css"/>
        <script src="https://kit.fontawesome.com/4cf75b295a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <header>
            <span><a href="/Grasshopper/index.php"><img src="/Grasshopper/grasshopper_logo.png" alt="Logo raffigurante un grillo" class="Logo"></img></a></span>
            <form class="searchBarContainer">
                <input type="text" placeholder="Cerca..." class="searchBar"></input>
                <button type="submit" class="searchButton"><i class="fa-solid fa-magnifying-glass"></i></Button>
            </form>
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
    </body>
</html>