<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_secret = '6LcNIG8qAAAAAJaz7nOS1wBNES8L8VVydA4yGfjb';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    if (empty($recaptcha_response)) {
        echo 'Please complete the reCAPTCHA.';
        exit;
    }

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_keys = json_decode($response, true);

    if (intval($response_keys["success"]) !== 1) {
        echo 'Failed reCAPTCHA verification. Please try again.';
    } else {
        header('Location: https://app.getresponse.com/add_subscriber.html?' . http_build_query($_POST));
        exit;
    }
}
?>