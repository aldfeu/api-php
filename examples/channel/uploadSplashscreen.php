<?php
$api = new \Dacast\Api('YOUR_APIKEY');

$channel = $api->live->uploadSplashscreen([
    "id" => 'SET_YOUR_OWN_CHANNEL_ID',
    "file" => "./test/test.jpg" //image source
]);
var_dump($channel);