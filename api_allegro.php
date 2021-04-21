<?php

function getAccessToken(): String
{
    $authUrl = "https://allegro.pl.allegrosandbox.pl/auth/oauth/token?grant_type=client_credentials";
    $clientId = "...";
    $clientSecret = "...";

    $ch = curl_init($authUrl);

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERNAME, $clientId);
    curl_setopt($ch, CURLOPT_PASSWORD, $clientSecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $tokenResult = curl_exec($ch);
    $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($tokenResult === false || $resultCode !== 200) {
        exit ("Something went wrong");
    }

    $tokenObject = json_decode($tokenResult);

    return $tokenObject->access_token;
}

function main()
{
    echo "access_token = ", getAccessToken();
}

main();
 
