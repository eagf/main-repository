<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/detail.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="scripts/detail.js" defer></script>
    <title>Libeer vastgoed</title>

    <?php
    // $translatePercentage = 90;
    echo "<style>
        .visible {
            animation: slideArrow 1s forwards;
        }

        @keyframes slideArrow {
            to {
                transform: translateX(" . $translatePercentage . "%);
            }
        }
    </style>";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const targetIndex = <?php echo json_encode($imageIndex); ?>;
            const epcContainer = document.querySelector('#epc-container');
            const imagesEPC = document.querySelectorAll('#epc-blocks-container img');

            const animateEPCImages = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        let currentIndexEPC = 0;
                        const interval = setInterval(() => {
                            if (currentIndexEPC > 0 && currentIndexEPC <= targetIndex) {
                                imagesEPC[currentIndexEPC - 1].classList.remove('scale-up');
                                imagesEPC[currentIndexEPC - 1].classList.add('scale-back');
                            }
                            if (currentIndexEPC < imagesEPC.length && currentIndexEPC <= targetIndex) {
                                imagesEPC[currentIndexEPC].classList.add('scale-up');
                                currentIndexEPC++;
                            } else {
                                clearInterval(interval);
                                observer.unobserve(epcContainer);
                            }
                        }, 100);
                    }
                });
            };

            const options = {
                root: null,
                threshold: 0.
            };

            const observer = new IntersectionObserver(animateEPCImages, options);
            observer.observe(epcContainer);
        });
    </script>



</head>

<body>

    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div id="pand-details-container">

            <div id="titel-container">
                <h1><?php echo htmlspecialchars($pandDetails['titel']); ?></h1>
            </div>

            <!-- ============== carousel ============== -->

            <div class="slideshow-container">
                <?php foreach ($afbeeldingenURLs as $index => $url) {
                    $beschrijving = $beschrijvingen[$index] ?? ''; // Fallback if no description
                    echo '<div class="mySlides fade">';
                    echo '<div class="numbertext">' . ($index + 1) . ' / ' . $totalImages . '</div>';
                    echo '<img src="' . htmlspecialchars($url) . '" style="width:100%">';
                    if (!empty($beschrijving)) {
                        echo '<div class="text">' . htmlspecialchars($beschrijving) . '</div>';
                    }
                    echo '</div>';
                } ?>

                <!-- Next and previous buttons -->
                <a class="prev">&#10094;</a>
                <a class="next">&#10095;</a>

                <!-- Close Button -->
                <div class="close-btn">&times;</div>
            </div>

            <!-- The dots/circles -->
            <div id="dot-container">
                <?php foreach ($afbeeldingenURLs as $index => $afbeelding) : ?>
                    <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span>
                <?php endforeach; ?>
            </div>


            <!-- ============== verdere info ============== -->

            <div id="left-right-container">

                <div id="adres-type-container" class="detail-container">
                    <p><strong>Adres:</strong>
                        <?php
                        echo (
                            htmlspecialchars($pandDetails['straat']) . " " .
                            htmlspecialchars($pandDetails['nr']) .
                            (!empty($pandDetails['bus']) ? " bus " . htmlspecialchars($pandDetails['bus']) : "") . " - " .
                            htmlspecialchars($pandDetails['postcode']) . " " .
                            htmlspecialchars($pandDetails['gemeente'])
                        );
                        ?>
                    </p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($pandDetails['type']); ?></p>
                    <?php if ($pandDetails['subtype'] != "Standaard") : ?>
                        <p><strong>Subtype:</strong> <?php echo htmlspecialchars($pandDetails['subtype']); ?></p>
                        <p><strong>Aanvulling Subtype:</strong> <?php echo htmlspecialchars($pandDetails['aanvullingSubtype']); ?></p>
                    <?php endif; ?>
                    <div id="google-maps-link-container">
                        <?php
                        echo "<a href=\"{$googleMapsLink}\" target=\"_blank\">Bekijk op Google Maps</a>";
                        ?>
                    </div>
                </div>

                <div id="beschrijving-container" class="detail-container">
                    <p><?php echo nl2br(htmlspecialchars($pandDetails['tekst'])); ?></p>
                </div>

                <div id="info1-container" class="detail-container">
                    <p><strong>Prijs:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['prijs'], 2, ',', '.')); ?></p>
                    <p><strong>Registratierechten of BTW:</strong> <?php echo htmlspecialchars($pandDetails['registratierechtenBTW']); ?></p>
                    <p><strong>Vrij Op:</strong> <?php echo htmlspecialchars($pandDetails['vrijOp']); ?></p>
                    <p><strong>Kadastraal Inkomen:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['kadastraalInkomen'], 2, ',', '.')); ?></p>
                </div>

                <div id="info2-container" class="detail-container">
                    <p><strong>Bouwjaar:</strong> <?php echo htmlspecialchars((string)$pandDetails['bouwjaar']); ?></p>

                    <p><strong>Grondoppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['grondoppervlakte'], 0, ',', '.')); ?> m²</p>
                    <p><strong>Bruto Vloeroppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['brutoVloeroppervlakte'], 0, ',', '.')); ?> m²</p>
                    <!-- !!!!!!! Onleesbaar in geschreven overzicht -->
                    <p><strong>EPC Index:</strong> <?php echo htmlspecialchars(number_format($pandDetails['epcIndex']), 0); ?></p>
                </div>

            </div>

            <!-- ============== EPC ============== -->

            <div id="epc-container" class="detail-container">
                <div id="epc-arrow-container">
                    <img src="assets/img/arrow-down.png" alt="arrow-down">
                </div>
                <div id="epc-blocks-container">
                    <img src="assets/img/f.png" alt="epc-f">
                    <img src="assets/img/e.png" alt="epc-e">
                    <img src="assets/img/d.png" alt="epc-d">
                    <img src="assets/img/c.png" alt="epc-c">
                    <img src="assets/img/b.png" alt="epc-b">
                    <img src="assets/img/a.png" alt="epc-a">
                    <img src="assets/img/a+.png" alt="epc-a+">
                </div>
            </div>

            <!-- ============== kamers / indeling ============== -->

            <?php if (!empty($pandDetails['kamers'])) : ?>
                <div id="indeling-container" class="detail-container">
                    <h3>Indeling</h3>
                    <?php foreach ($pandDetails['kamers'] as $roomType => $rooms) : ?>
                        <h4><?php echo htmlspecialchars($roomType); ?></h4>
                        <ul>
                            <?php
                            $roomCounter = 1;
                            $showCounter = count($rooms) >= 2;
                            ?>
                            <?php foreach ($rooms as $room) : ?>
                                <li>
                                    <?php
                                    if ($showCounter) {
                                        echo $roomCounter++ . ': ';
                                    }
                                    ?>
                                    Oppervlakte: <?php echo htmlspecialchars(number_format($room['kamerOppervlakte'], 0, ',', '.')); ?> m²,
                                    Detail: <?php echo htmlspecialchars($room['kamerDetail']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



            <!-- ============== wettelijke informatie ============== -->

            <div id="wettelijke-container" class="detail-container">
                <h3>Wettelijke Informatie</h3>
                <p><strong>Energie Label:</strong> <?php echo htmlspecialchars($pandDetails['energieLabel']); ?></p>
                <p><strong>Stedenbouwkundige Vergunning:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeVergunning'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Verkavelingsvergunning:</strong> <?php echo htmlspecialchars($pandDetails['verkavelingsvergunning'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Voorkooprecht:</strong> <?php echo htmlspecialchars($pandDetails['voorkooprecht'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Stedenbouwkundige Bestemming:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeBestemming']); ?></p>
                <p><strong>Dagvaarding en Herstelvordering:</strong> <?php echo htmlspecialchars($pandDetails['dagvaardingEnHerstelvordering'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['effectiefOverstromingsgevoelig'] ? 'Effectief overstromingsgevoelig' : 'Niet effectief overstromingsgevoelig'); ?></p>
                <p><strong>Mogelijk Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['mogelijkOverstromingsgevoelig'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Afgebakend Overstromingsgebied:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendOverstromingsgebied'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Afgebakende Oeverzone:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendeOeverzone'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Risicozone voor Overstromingen:</strong> <?php echo htmlspecialchars($pandDetails['risicozoneVoorOverstromingen'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Overstromingskans Perceel (P-score):</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansPerceel']); ?></p>
                <p><strong>Overstromingskans Gebouw (G-score):</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansGebouw']); ?></p>
                <p><strong>Erfgoed:</strong> <?php echo htmlspecialchars($pandDetails['erfgoed'] ? 'Ja' : 'Nee'); ?></p>
            </div>

            <!-- Ongebruikte gegevens -->
            <!-- <p><strong>Gemeente:</strong> <?php echo htmlspecialchars($pandDetails['gemeente']); ?></p>
                <p><strong>Aantal Slaapkamers:</strong> <?php echo htmlspecialchars((string)$pandDetails['aantalSlaapkamers']); ?></p> -->

        </div>

        <?php include('includes/footer.php'); ?>
</body>

</html>