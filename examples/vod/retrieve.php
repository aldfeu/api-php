<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$vod = $api->vod->all();
var_dump($vod);