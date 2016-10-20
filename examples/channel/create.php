<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'title' => 'New channel',
    'description' => 'description of my new channel, it\'s awesome'
];

$channel = $api->live->create($data);
var_dump($channel);