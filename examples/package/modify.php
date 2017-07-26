<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'id' => 'SET_OWN_PACKAGE_ID',
    'title' => 'Package modified'
];

$package = $api->package->modify($data);
var_dump($package);