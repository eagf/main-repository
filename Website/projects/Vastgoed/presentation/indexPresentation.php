<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./scripts/index.js" defer></script>
    <title>Libeer vastgoed</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="title-container">
            <h1 class="main-title">Libeer Vastgoed</h1>
        </div>

        <!-- ============= Index carousel ============= -->

        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($pandenHomepage as $pand) : ?>
                    <div class="swiper-slide">
                        <a class="carousel-card" href="detail.php?pandID=<?php echo htmlspecialchars($pand['pandID']); ?>">
                            <img src="<?php echo htmlspecialchars($pand['afbeeldingURL']); ?>" alt="Carousel Image">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ============= Content under carousel ============= -->

        <div id="content-container">

            <!-- ============= Main Quote ============= -->
            <div class="quote-main">
                "Wat is een perfect huis? De plaats waar je nooit genoeg kastruimte hebt, maar toch altijd iets kwijt bent."
            </div>

            <!-- ============= Client Quotes Section ============= -->

            <div class="content-section left">
                <div class="client-quote">
                    <p>"Wat een verademing om een immobiliënkantoor te vinden dat niet alleen kennis heeft van de markt, maar ook echt luistert naar wat de klant wil. Ze zijn meesters in het vinden van het perfecte pand binnen elk budget, zonder concessies te doen aan kwaliteit of service."</p>
                </div>
            </div>
            <div class="content-section right">
                <div class="client-quote">
                    <p>"De expertise van dit immobiliënkantoor gaat verder dan alleen het vinden van een geschikte woning; ze creëren een omgeving waarin klanten zich gehoord en begrepen voelen. Met een scherp inzicht in de markttrends, bieden ze een dienstverlening die gericht is op het overtreffen van verwachtingen."</p>
                </div>
            </div>
            <div class="content-section left">
                <div class="client-quote">
                    <p>"Wat een verfrissende ervaring om samen te werken met een immobiliënkantoor dat echt begrijpt wat je zoekt. Ze zijn niet alleen deskundig in hun vakgebied, maar ze nemen ook de tijd om te begrijpen wat je nodig hebt en willen, en leveren vervolgens resultaten die dat overtreffen."</p>
                </div>
            </div>
            <div class="content-section right">
                <div class="client-quote">
                    <p>"Als jong getrouwd koppel waren we op zoek naar een immobiliënkantoor dat onze dromen kon waarmaken, en dat vonden we hier. Hun visie op vastgoed sprak ons meteen aan, en ze wisten precies hoe ze ons konden begeleiden naar ons ideale thuis."</p>
                </div>
            </div>
            <div class="content-section left">
                <div class="client-quote">
                    <p>"Het was geweldig om samen te werken met een immobiliënkantoor dat niet alleen professioneel was, maar ook echt begreep wat we wilden. Ze namen de tijd om naar onze wensen te luisteren en vonden binnen ons budget een prachtig huis dat aan al onze verwachtingen voldeed."</p>
                </div>
            </div>
            <div class="content-section right">
                <div class="client-quote">
                    <p>"Dit immobiliënkantoor maakte onze zoektocht naar ons eerste huis onvergetelijk. Ze namen ons bij de hand, hielden rekening met ons budget en vonden een woning die perfect aansloot bij onze dromen en behoeften. Met hun deskundige begeleiding voelden we ons echt thuis, nog voordat we de sleutels in handen hadden."</p>
                </div>
            </div>
            <div class="content-section left">
                <div class="client-quote">
                    <p>"Dit immokantoor, onder leiding van Michaël, verdient een dikke pluim voor hun expertise en tomeloze inzet. Ze deden echt alles om niet alleen de juiste koper voor ons huis te vinden. Michaël weet echt waar hij het over heeft en gaat nog een stapje verder om de perfecte match te vinden. Geweldige service."</p>
                </div>
            </div>
            <div class="content-section right">
                <div class="client-quote">
                    <p>"Dit immokantoor vond de perfecte koper voor ons huis, waardoor we ons geen zorgen hoefden te maken. Ze namen alle administratieve rompslomp uit handen en maakten het verkoopproces moeiteloos en stressvrij."</p>
                </div>
            </div>

        </div>

    </div>

    <?php include('includes/footer.php'); ?>
    
</body>

</html>