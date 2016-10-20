<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'title' => 'New package'
];

$package = $api->package->create($data);
var_dump($package);