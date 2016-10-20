<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$data = [
    'id' => 'SET_OWN_VOD_ID',
    'title' => 'Vod modified',
    'description' => 'it\'s awesome'
];

$vod = $api->vod->modify($data);
var_dump($vod);