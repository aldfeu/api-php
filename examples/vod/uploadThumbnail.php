<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');

$vod = $api->vod->uploadThumbnail([
    "id" => 'SET_YOUR_OWN_VOD_ID',
    "file" => "./test/test.jpg" //image source
]);
var_dump($vod);