<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'title' => 'New playlist'
];

$playlist = $api->playlist->create($data);
var_dump($playlist);