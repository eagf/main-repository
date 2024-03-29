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
            <img src="assets/img/title.png" alt="Libeer vastgoed titel">
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

            <div class="content-section right">
                <h2>Section Title 1</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem doloribus omnis eveniet modi ex error, illo aperiam culpa enim expedita iste tenetur in voluptate dignissimos debitis autem ullam esse similique quos. Ipsum natus vitae quisquam architecto nisi aspernatur, officia consequatur molestias magni neque! Dignissimos, id. Voluptas repudiandae soluta modi eos?</p>
            </div>
            <div class="content-section left">
                <h2>Section Title 2</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus sed accusantium, ad id veritatis facere ullam ducimus illo minus hic? Odio quia voluptate doloribus praesentium.</p>
            </div>
            <div class="content-section right">
                <h2>Section Title 3</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat beatae totam veritatis dolore necessitatibus. Aliquam nisi suscipit eaque sapiente commodi maiores odit consectetur pariatur molestiae mollitia quibusdam ullam, non optio aut soluta corporis earum fugiat dolore voluptates voluptas laudantium est dignissimos veritatis. Quaerat laboriosam quia itaque delectus nulla obcaecati quod facere amet placeat. Itaque, delectus beatae? Odio doloribus animi corporis!</p>
            </div>
            <div class="content-section left">
                <h2>Section Title 4</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur distinctio perspiciatis, quos repellat itaque quas!</p>
            </div>

        </div>


    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>