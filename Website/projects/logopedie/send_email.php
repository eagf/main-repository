<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect post data from the form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Specify the recipient email
    $to = "isabellecorneillie@hotmail.com";

    // Set the email subject
    $subject = "Nieuw bericht van $name via de website";

    // Build the email content
    $email_content = "Naam: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Bericht:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $subject, $email_content, $email_headers)) {
        // Redirect to a thank-you page or display a success message
        echo "Bedankt! Uw bericht is verzonden.";
    } else {
        // Log the error or display an error message
        echo "Oeps! Er was een probleem met het verzenden van uw bericht. Probeer het later opnieuw.";
    }
} else {
    // Not a POST request, handle differently or redirect
    echo "Oeps! Er is iets fout gegaan.";
}
