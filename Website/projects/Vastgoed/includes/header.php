<?php
$currentFile = $_SERVER["PHP_SELF"];
$partsFileName = explode('/', $currentFile);
$currentPage = end($partsFileName);

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
</head>

<body>
    <div id="wrapper">
        <header>
            <div id="logo-div">
                <a id="logo-link" href="index.php">
                    <img id="logo" src="./assets/img/logo.png" alt="Logo Libeer">
                </a>
            </div>
            <nav id="header-nav">
                <ul>
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


                </ul>
            </nav>
        </header>