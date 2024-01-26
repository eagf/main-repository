<?php
$currentFile = $_SERVER["PHP_SELF"];
$partsFileName = explode('/', $currentFile);
$currentPage = end($partsFileName);
?>

<script src="./scripts/header.js" defer></script>

<header>
    <div id="logo-and-icon-div">
        <div id="logo-div">
            <a id="logo-link" href="index.php">
                <img id="logo" src="./assets/img/logo.svg" alt="Logo Libeer">
            </a>
        </div>

        <div id="hamburger-icon" onclick="toggleNav()">
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
            <li class="<?php echo ($currentPage === 'rentmeesterschap.php') ? 'active' : ''; ?>">
                <a href="rentmeesterschap.php" class="header-link">
                    Rentmeesterschap
                </a>
            </li>
            <li class="<?php echo ($currentPage === 'contact.php') ? 'active' : ''; ?>">
                <a href="contact.php" class="header-link">
                    Contact
                </a>
            </li>
            <li class="<?php echo ($currentPage === 'pandInputForm.php') ? 'active' : ''; ?>">
                <a href="pandInputForm.php" class="header-link">
                    Admin
                </a>
            </li>
        </ul>
    </nav>
</header>