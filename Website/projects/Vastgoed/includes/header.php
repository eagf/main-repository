<?php
$currentFile = $_SERVER["PHP_SELF"];
$partsFileName = explode('/', $currentFile);
$currentPage = end($partsFileName);

?>

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
                <li class="<?php echo ($currentPage === 'pandInputForm.php') ? 'active' : ''; ?>">
                    <a href="pandInputForm.php" class="header-link">
                        +
                    </a>
                </li>


            </ul>
        </nav>
    </header>