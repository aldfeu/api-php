<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$data = [
    'title' => 'New playlist'
];

$playlist = $api->playlist->create($data);
var_dump($playlist);