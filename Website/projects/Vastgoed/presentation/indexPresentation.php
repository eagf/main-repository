<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="./scripts/index.js" defer></script>
    <title>Libeer vastgoed</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="title-container">

            <img src="assets/img/title.png" alt="Libeer vastgoed titel">

        </div>

        <div class="index-carousel-container">
            <?php foreach ($pandenHomepage as $pand) : ?>
                <div>
                    <a class="carousel-card" href="detail.php?pandID=<?php echo htmlspecialchars($pand['pandID']); ?>">
                        <img src="<?php echo htmlspecialchars($pand['afbeeldingURL']); ?>" alt="Carousel Image">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="slick/slick.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.index-carousel-container').slick({
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    swipeToSlide: true,
                    centerMode: true,
                    centerPadding: '60px',
                    slidesToShow: 3,
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '40px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '40px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        </script>

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