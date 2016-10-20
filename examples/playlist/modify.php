<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$data = [
    'id' => 'SET_OWN_PLAYLIST_ID',
    'title' => 'Playlist modified',
    'description' => 'it\'s awesome'
];

$playlist = $api->playlist->modify($data);
var_dump($playlist);