<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');

$vod = $api->vod->uploadVod([
    "originalFilename" => 'test',
    "file" => "./test/test.mp4"
], function ($progress){
    return $progress;
}, function ($success){
    return $success;
});