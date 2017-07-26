<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$package = $api->package->uploadThumbnail([
    "id" => 'SET_YOUR_OWN_PACKAGE_ID',
    "file" => "./test/test.jpg" //image source
]);
var_dump($package);