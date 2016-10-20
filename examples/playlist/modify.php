<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'id' => 'SET_OWN_PLAYLIST_ID',
    'title' => 'Playlist modified',
    'description' => 'it\'s awesome'
];

$playlist = $api->playlist->modify($data);
var_dump($playlist);