<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'title' => 'New channel',
    'description' => 'description of my new channel, it\'s awesome'
];

$channel = $api->live->create($data);
var_dump($channel);