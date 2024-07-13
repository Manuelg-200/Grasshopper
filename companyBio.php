<?php 
    session_start();
    include 'DatabaseUtils/rememberLogin.php'; 
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Chi Siamo</title>
        <link rel="stylesheet" type="text/css" href="companyBioStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="WhoWeAreContainer">
            <div>
                <h1>La nostra storia</h1>
                <p>Grasshopper è nata nel 2023, con la vittoria dello scudetto del Napoli. Nella conseguente invasione di campo
                    da parte dei tifosi, un ragazzo particolarmente appassionato, venne inquadrato mentre raccoglieva un pezzo 
                    di terreno e la riponeva sapientemente in un sacchetto di plastica. Il giorno dopo, la stessa zolla
                    era disponibile su Ebay.</p>
                <p>Da quel fatidico momento, al nostro misterioso fondatore è venuta l'idea di creare un negozio online
                    che permettesse a tutti di portare a casa un pezzo di storia, un pezzo di campo.</p>
                <p>Da allora, Grasshopper è cresciuta, e ora vende zolle di terreno da tutti gli stadi più importanti del mondo,
                    con certificato di autenticità (che non potete vedere), e con la garanzia (più o meno) che siano state
                    prelevate direttamente dagli stadi.</p>
            </div>
        </div>
        
        <div class="WhoWeAreContainer second">
            <div>
                <h1>I nostri metodi</h1>
                <p>Grasshopper è un'azienda che si basa sulla fiducia. La fiducia che i nostri clienti ciecamente ripongono in noi,
                    e la fiducia che i nostri "fornitori" non si accorgano di quello che facciamo.</p>
                <p>Il nostro team di prelevatori professionisti è in grado di prelevare zolle di terreno da qualsiasi stadio,
                    in qualsiasi momento, senza farsi notare. Questo è il nostro punto di forza, e la nostra garanzia di qualità.</p>
                <p>Nei nostri archivi sono ormai presenti centinaia di progetti prelevati con gli stessi metodi di stadi di tutto il mondo,
                    che ci permettono di entrarne e uscirne senza lasciare traccia.</p>
            </div>
        </div>
    </body>
</html>