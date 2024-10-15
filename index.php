<?php

use Google\Service\Batch\Script;
use Google\Service\Oauth2 as Google_Service_Oauth2;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fli Desk - Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="google-signin-client_id" content="582770276714-fk3sijm1u1ddl9qj3i6v6248gi0jpre0.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="./main.js" defer type="module"></script>
    
</head>

<body>
<?php
require_once __DIR__ . '/../vendor/autoload.php';

// init configuration
$clientID = '582770276714-fk3sijm1u1ddl9qj3i6v6248gi0jpre0.apps.googleusercontent.com';
$clientSecret = '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';



$redirectUri = 'http://localhost:3002/';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
?>
 
<?php
  // now you can use this profile info to create account in your website and make user logged in.
} else {
?>
    <div class="container text-center mt-5">
        <h2>Welcome to Fli Desk</h2>
        <p>Please sign in to access your dashboard</p>

        <div class="d-flex justify-content-center">
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>

        <p id="status" class="mt-3"></p>
    </div>

    <script src="./google-signin.js"></script>

<?php } ?>

</body>
</html>
