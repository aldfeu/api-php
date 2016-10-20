<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$vod = $api->vod->uploadVod([
    "originalFilename" => 'NAME OF YOUR FILENAME',
    "file" => "./test/test.mp4" //vod source
]);
var_dump($vod);