<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'id' => 'SET_OWN_PACKAGE_ID'
];

$package = $api->package->delete($data);
var_dump($package);