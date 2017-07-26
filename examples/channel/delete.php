<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'id' => 'SET_OWN_CHANNEL_ID',
];

$channel = $api->live->delete($data);
var_dump($channel);