<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');

$package = $api->package->uploadSplashscreen([
    "id" => 'SET_YOUR_OWN_PACKAGE_ID',
    "file" => "./test/test.jpg" //image source
]);
var_dump($package);