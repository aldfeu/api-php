<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'title' => 'New package'
];

$package = $api->package->create($data);
var_dump($package);