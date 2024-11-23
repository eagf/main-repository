<?php
//submitContactForm.php

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
        // Redirect back with an error
        header('Location: ../presentation/contactPresentation.php?status=error&message=invalid_email');
        exit;
    }

    // Email settings
    $to = "info@michaellibeer.be";
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
    $headers .= "From: $email" . "\r\n";

    // Send the email
    $mailToAdmin = mail($to, $subject, $emailContent, $headers);

    if ($mailToAdmin) {
        // Redirect back with success
        header('Location: ../contact.php?status=success');
    } else {
        // Redirect back with error
        header('Location: ../contact.php?status=error&message=email_failure');
    }
} else {
    // Redirect back with error if accessed directly
    header('Location: ../contact.php?status=error&message=invalid_access');
}

exit;
