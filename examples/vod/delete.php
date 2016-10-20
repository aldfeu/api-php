<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$data = [
    'id' => 'SET_OWN_VOD_ID',
];

$vod = $api->vod->delete($data);
var_dump($vod);