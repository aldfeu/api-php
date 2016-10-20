<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');

$playlist = $api->playlist->uploadSplashscreen([
    "id" => 'SET_YOUR_OWN_PLAYLIST_ID',
    "file" => "./test/test.jpg" //image source
]);*/
var_dump($playlist);