<?php
$api = new \Dacast\Api('YOUR_DACAST_API');

$playlist = $api->playlist->uploadThumbnail([
    "id" => 'SET_YOUR_OWN_PLAYLIST_ID',
    "file" => "./test/test.jpg" //image source
]);*/
var_dump($playlist);