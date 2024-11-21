<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set your Gmail address as the recipient
        $to = "dantetaypin@gmail.com"; // Your Gmail address
        
        // Subject of the email
        $subject = "New Subscription from Kape Kuy's Website";
        
        // Message content
        $message = "You have a new subscriber! Their email address is: $email";
        
        // Headers to ensure proper formatting
        $headers = "From: no-reply@yourwebsite.com\r\n";
        $headers .= "Reply-To: no-reply@yourwebsite.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send the email
        $mail_sent = mail($to, $subject, $message, $headers);

        if ($mail_sent) {
            // You can also add the email to your text file if you'd like
            $file = fopen("subscribers.txt", "a");
            fwrite($file, $email . PHP_EOL);
            fclose($file);

            // Redirect or show success message
            echo "Thank you for subscribing! We will be in touch soon.";
        } else {
            // Handle mail failure
            echo "There was a problem with the subscription. Please try again later.";
        }
    } else {
        // Handle invalid email
        echo "Invalid email address. Please try again.";
    }
} else {
    // Prevent direct access
    echo "Invalid request.";
}
?>
