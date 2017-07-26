<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'title' => 'New playlist'
];

$playlist = $api->playlist->create($data);
var_dump($playlist);