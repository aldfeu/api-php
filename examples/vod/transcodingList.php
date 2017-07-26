<?php
$api = new \Dacast\Api('YOUR_APIKEY');

$vod = $api->vod->transcodingList([
    "vod_id" => 'VOD_ID'
]);
var_dump($vod);