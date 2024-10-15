<?php
require_once 'C:\Users\manuk\Fli DESK PRoject\vendor\autoload.php'; // Include Google Client Library

$client = new Google_Client(['client_id' => "582770276714-fk3sijm1u1ddl9qj3i6v6248gi0jpre0.apps.googleusercontent.com"]);  
$id_token = $_POST['idtoken'];

try {
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
        // Store user session and redirect to dashboard
        session_start();
        $_SESSION['userid'] = $payload['sub'];
        $_SESSION['email'] = $payload['email'];
        echo 'success';
        
    } else {
        echo 'error';
    }
} catch (Exception $e) {
    echo 'error';
}

