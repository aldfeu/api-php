<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$data = [
    'title' => 'New package'
];

$package = $api->package->create($data);
var_dump($package);