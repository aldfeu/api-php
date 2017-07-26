<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'id' => 'SET_OWN_CHANNEL_ID',
    'title' => 'New channel',
    'description' => 'description of my new channel, it\'s awesome'
];

$channel = $api->live->modify($data);
var_dump($channel);