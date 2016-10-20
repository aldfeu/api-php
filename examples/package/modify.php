<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'id' => 'SET_OWN_PACKAGE_ID',
    'title' => 'Package modified'
];

$package = $api->package->modify($data);
var_dump($package);