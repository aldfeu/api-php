<?php
$api = new \Dacast\Api('YOUR_DACAST_API');

$vod = $api->live->uploadSplashscreen([
    "id" => 'SET_YOUR_OWN_VOD_ID',
    "file" => "./test/test.jpg" //image source
]);
var_dump($vod);