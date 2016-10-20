<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$data = [
    'id' => 'SET_OWN_VOD_ID',
];

$vod = $api->vod->delete($data);
var_dump($vod);