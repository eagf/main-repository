<?php
$currentFile = $_SERVER["PHP_SELF"];
$partsFileName = explode('/', $currentFile);
$currentPage = end($partsFileName);

// Get the current page name
$pageName = basename($_SERVER['PHP_SELF'], ".php");

// Define the banner image based on the page name
$bannerImage = "";
$bannerClass = "";
switch ($pageName) {
    case "index":
        $bannerImage = "bannerIndexAanbod.jpg";
        $bannerClass = "top-aligned";
        break;
    case "aanbod":
        $bannerImage = "bannerIndexAanbod.jpg";
        $bannerClass = "top-aligned";
        break;
    case "verkopen":
        $bannerImage = "bannerVerkoop.png";
        break;
    case "verhuren":
        $bannerImage = "bannerVerhuur.png";
        break;
    case "contact":
        $bannerImage = "bannerContact.jpg";
        break;
    default:
        $bannerImage = "bannerDefault.png";
        break;
}

?>

<script src="./scripts/header.js" defer></script>

<header>
    <div id="logo-and-icon-div">
        <div id="logo-div">
            <a id="logo-link" href="index.php">
                <img id="logo" src="./assets/img/logo.svg" alt="Logo Libeer">
            </a>
        </div>
        <div id="banner-div">
            <img src="./assets/img/<?php echo $bannerImage; ?>" alt="Libeer banner" id="banner" class="<?php echo $bannerClass; ?>">
        </div>

        <div id="hamburger-icon">
            <!-- onclick="toggleNav()" -->
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <nav id="header-nav">
        <ul id="header-nav-ul">
            <li class="<?php echo ($currentPage === 'aanbod.php') ? 'active' : ''; ?>">
                <a href="aanbod.php" class="header-link">
                    Ons aanbod
                </a>
            </li>
            <li class="<?php echo ($currentPage === 'verkopen.php') ? 'active' : ''; ?>">
                <a href="verkopen.php" class="header-link">
                    Verkopen
                </a>
            </li>
            <li class="<?php echo ($currentPage === 'verhuren.php') ? 'active' : ''; ?>">
                <a href="verhuren.php" class="header-link">
                    Verhuren
                </a>
            </li>
            <li class="<?php echo ($currentPage === 'contact.php') ? 'active' : ''; ?>">
                <a href="contact.php" class="header-link">
                    Contact
                </a>
            </li>
        </ul>
    </nav>

    <div id="scroll-to-top">
        <img src="./assets/img/arrowUp.png" alt="Scroll to Top" />
    </div>

</header>