<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$data = [
    'id' => 'SET_OWN_PLAYLIST_ID'
];

$playlist = $api->playlist->delete($data);
var_dump($playlist);