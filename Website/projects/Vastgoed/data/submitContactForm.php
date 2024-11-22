<?php
require_once 'DBConfig.php';

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $naam = htmlspecialchars(trim($_POST['naam']));
    $voornaam = htmlspecialchars(trim($_POST['voornaam']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST['onderwerp']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Ongeldig e-mailadres. Probeer opnieuw.</p>";
        exit;
    }

    // Email settings
    $to = "eliasferket@gmail.com"; // Replace with the recipient's email address
    $subject = "Nieuw contactformulierbericht: $onderwerp";

    // Email content
    $emailContent = "
        <html>
        <head>
            <title>Nieuw bericht via het contactformulier</title>
        </head>
        <body>
            <h2>Contactformulier bericht</h2>
            <p><strong>Naam:</strong> $naam</p>
            <p><strong>Voornaam:</strong> $voornaam</p>
            <p><strong>E-mailadres:</strong> $email</p>
            <p><strong>Onderwerp:</strong> $onderwerp</p>
            <p><strong>Bericht:</strong></p>
            <p>$message</p>
        </body>
        </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@libeervastgoed.be" . "\r\n";

    // Send the email using PHP's mail function
    if (mail($to, $subject, $emailContent, $headers)) {
        echo "<p>Bedankt voor uw bericht. We nemen zo snel mogelijk contact met u op.</p>";
    } else {
        echo "<p>Er is een fout opgetreden bij het verzenden van uw bericht. Probeer het later opnieuw.</p>";
    }
} else {
    // Redirect or display an error if the form is accessed directly
    echo "<p>Ongeldige toegang. Gebruik het contactformulier.</p>";
}
