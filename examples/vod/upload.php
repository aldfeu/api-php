<?php
$api = new \Dacast\Api('YOUR_APIKEY');

$vod = $api->vod->uploadVod([
    "originalFilename" => 'test',
    "file" => "./test/test.mp4"
], function ($progress){
    return $progress;
}, function ($success){
    return $success;
});