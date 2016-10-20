<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$vod = $api->vod->uploadVod([
    "originalFilename" => 'NAME OF YOUR FILENAME',
    "file" => "./test/test.mp4" //vod source
]);
var_dump($vod);