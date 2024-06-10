<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="./styles/detail.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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

            <div class="slideshow-container swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($afbeeldingenURLs as $index => $url) : ?>
                        <?php $beschrijving = $beschrijvingen[$index] ?? ''; // Fallback if no description 
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo htmlspecialchars($url); ?>" alt="Image <?php echo $index + 1; ?>">
                            <?php if (!empty($beschrijving)) : ?>
                                <div class="text"><?php echo htmlspecialchars($beschrijving); ?></div>
                            <?php endif; ?>
                            <div class="numbertext"><?php echo $index + 1; ?> / <?php echo $totalImages; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-button-prev swiper-button-hidden"></div>
                <div class="swiper-button-next swiper-button-hidden"></div>

                <div class="close-btn">&times;</div>

                <div id="dot-container" class="swiper-pagination"></div>
                <div id="numbertext" class="swiper-pagination-text"></div>
            </div>

            <!-- ============== verdere info =========== === -->

            <div id="left-right-container">

                <div id="adres-type-container" class="detail-container">
                    <div class="detail-container-text">
                        <p><strong>Adres:</strong>
                            <?php
                            echo (
                                "<a class='address-link' href=\"{$googleMapsLink}\" target=\"_blank\">" .
                                htmlspecialchars($pandDetails['straat']) . " " .
                                htmlspecialchars($pandDetails['nr']) .
                                (!empty($pandDetails['bus']) ? " bus " . htmlspecialchars($pandDetails['bus']) : "") . " - " .
                                htmlspecialchars($pandDetails['postcode']) . " " .
                                htmlspecialchars($pandDetails['gemeente']) . "</a>"
                            );
                            ?>
                        </p>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($pandDetails['type']); ?></p>
                        <?php if ($pandDetails['subtype'] != "Standaard") : ?>
                            <p><strong>Subtype:</strong> <?php echo htmlspecialchars($pandDetails['subtype']); ?></p>
                            <p><strong>Aanvulling Subtype:</strong> <?php echo htmlspecialchars($pandDetails['aanvullingSubtype']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="detail-container-img">
                        <a href="<?php echo $googleMapsLink; ?>" target="_blank" class="address-link" onmouseover="changeImage()" onmouseout="resetImage()" onclick="clickedImage()">
                            <img id="locationImg" src="./assets/img/locatieBlauw.png" alt="locatie">
                        </a>
                    </div>

                </div>

                <div id="beschrijving-container" class="detail-container">
                    <p><?php echo nl2br(htmlspecialchars($pandDetails['tekst'])); ?></p>
                </div>

                <div id="info1-container" class="detail-container">
                    <div class="detail-container-text">
                        <p><strong>Prijs:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['prijs'], 0, ',', '.')); if ($pandDetails['status'] == "Te huur") {?> / maand<?php }; ?></p>
                        <p><strong>Bezoek op:</strong> <?php echo htmlspecialchars($pandDetails['bezoekOp']); ?></p>
                        <p><strong>Vrij Op:</strong> <?php echo htmlspecialchars($pandDetails['vrijOp']); ?></p>
                        <?php if (!empty($pandDetails['kadastraalInkomen'])) { ?>
                            <p><strong>Kadastraal Inkomen:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['kadastraalInkomen'], 0, ',', '.')); ?></p>
                        <?php } ?>
                    </div>
                    <div class="detail-container-img">
                        <img src="./assets/img/prijsklasseBlauw.png" alt="prijsklasse">
                    </div>
                </div>

                <div id="info2-container" class="detail-container">
                    <div class="detail-container-text">
                        <?php if (!empty($pandDetails['bouwjaar'])) { ?>
                            <p><strong>Bouwjaar:</strong> <?php echo htmlspecialchars((string)$pandDetails['bouwjaar']); ?></p>
                        <?php }
                        if (!empty($pandDetails['grondoppervlakte'])) { ?>
                            <p><strong>Grondoppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['grondoppervlakte'], 0, ',', '.')); ?> m²</p>
                        <?php }
                        if (!empty($pandDetails['brutoVloeroppervlakte'])) { ?>
                            <p><strong>Bruto Vloeroppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['brutoVloeroppervlakte'], 0, ',', '.')); ?> m²</p>
                        <?php }
                        if (!empty($pandDetails['aantalSlaapkamers'])) { ?>
                            <p><strong>Aantal Slaapkamers:</strong> <?php echo htmlspecialchars((string)$pandDetails['aantalSlaapkamers']); ?></p>
                        <?php } ?>
                    </div>
                    <div class="detail-container-img">
                        <img src="./assets/img/bouwjaarBlauw.png" alt="bouwjaar">
                    </div>
                </div>

            </div>

            <!-- ============== EPC ============== -->
            <div id="epc-container-container" class="detail-container">
                <h3>EPC</h3>
                <p><strong>EPC Index:</strong> <?php echo htmlspecialchars(number_format($pandDetails['epcIndex']), 0); ?></p>
                <p><strong>Energie Label:</strong> <?php echo htmlspecialchars($pandDetails['energieLabel']); ?></p>
                <p><strong>Renovatieverplichting:</strong> <?php echo htmlspecialchars($pandDetails['renovatieverplichting'] ? 'Ja' : 'Nee'); ?></p>

                <div id="epc-container">
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
            </div>

            <!-- ============== kamers / indeling ============== -->

            <?php if (!empty($pandDetails['kamers'])) : ?>
                <div id="indeling-container" class="detail-container">
                    <div class="detail-container-text">

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
                                        <?php if ($room['kamerOppervlakte'] != 0) { ?>
                                            Oppervlakte: <?php echo htmlspecialchars(number_format($room['kamerOppervlakte'], 0, ',', '.')); ?> m² <br>
                                        <?php }
                                        if (!empty($room['kamerDetail'])) {
                                            echo htmlspecialchars($room['kamerDetail']);
                                        } ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                    <div class="detail-container-img">
                        <img src="./assets/img/indelingBlauw.png" alt="indeling">
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============== wettelijke informatie ============== -->

            <div id="wettelijke-container" class="detail-container">
                <div class="detail-container-text">

                    <h3>Wettelijke Informatie</h3>
                    <p><strong>Stedenbouwkundige Vergunning:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeVergunning']); ?></p>
                    <?php if (!empty($pandDetails['stedenbouwkundigeVergunningInfo'])) { ?>
                        <p><strong>Extra info:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeVergunningInfo']); ?></p>
                    <?php } ?>
                    <p><strong>Verkavelingsvergunning:</strong> <?php echo htmlspecialchars($pandDetails['verkavelingsvergunning'] ? 'Ja' : 'Nee'); ?></p>
                    <?php if (!empty($pandDetails['verkavelingsvergunningInfo'])) { ?>
                        <p><strong>Extra info:</strong> <?php echo htmlspecialchars($pandDetails['verkavelingsvergunningInfo']); ?></p>
                    <?php } ?>
                    <p><strong>Voorkooprecht:</strong> <?php echo htmlspecialchars($pandDetails['voorkooprecht'] ? 'Ja' : 'Nee'); ?></p>
                    <?php if (!empty($pandDetails['voorkooprechtInfo'])) { ?>
                        <p><strong>Extra info:</strong> <?php echo htmlspecialchars($pandDetails['voorkooprechtInfo']); ?></p>
                    <?php } ?>
                    <p><strong>Stedenbouwkundige Bestemming:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeBestemming']); ?></p>

                    <p><strong>Dagvaarding en Herstelvordering:</strong> <?php echo htmlspecialchars($pandDetails['dagvaardingEnHerstelvordering'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>
                    <p><strong>Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['effectiefOverstromingsgevoelig'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>
                    <p><strong>Mogelijk Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['mogelijkOverstromingsgevoelig'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>
                    <p><strong>Afgebakend Overstromingsgebied:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendOverstromingsgebied'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>
                    <p><strong>Afgebakende Oeverzone:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendeOeverzone'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>
                    <p><strong>Risicozone voor Overstromingen:</strong> <?php echo htmlspecialchars($pandDetails['risicozoneVoorOverstromingen'] ? 'Van toepassing' : 'Niet van toepassing'); ?></p>

                    <p><strong>Overstromingskans perceelscore:</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansPerceel']); ?></p>
                    <p><strong>Overstromingskans gebouwscore:</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansGebouw']); ?></p>
                    <p><strong>Erfgoed:</strong> <?php echo htmlspecialchars($pandDetails['erfgoed'] ? 'Ja' : 'Nee'); ?></p>
                    <?php if (!empty($pandDetails['erfgoedInfo'])) { ?>
                        <p><strong>Extra info:</strong> <?php echo htmlspecialchars($pandDetails['erfgoedInfo']); ?></p>
                    <?php } ?>
                </div>
                <div class="detail-container-img">
                    <img src="./assets/img/wetgevingBlauw.png" alt="wetgeving">
                </div>
            </div>

            <!-- ================== UNUSED ================== -->

            <!-- <p><strong>Gemeente:</strong> <?php echo htmlspecialchars($pandDetails['gemeente']); ?></p> -->

        </div>

        <?php include('includes/footer.php'); ?>
</body>

</html>