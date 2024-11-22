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

    // Set the email recipient and subject
    $to = "eliasferket@gmail.com"; // Replace with your actual email
    $subject = "Nieuw contactformulierbericht: $onderwerp";

    // Format the email content
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

    // Set the email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $emailContent, $headers)) {
        // Redirect to a thank-you page or display a success message
        echo "<p>Bedankt voor uw bericht. We nemen zo snel mogelijk contact met u op.</p>";
    } else {
        // Display an error message if the email could not be sent
        echo "<p>Er is een fout opgetreden bij het verzenden van uw bericht. Probeer het later opnieuw.</p>";
    }
} else {
    // Redirect or display an error if the form is accessed directly
    echo "<p>Ongeldige toegang. Gebruik het contactformulier.</p>";
}
