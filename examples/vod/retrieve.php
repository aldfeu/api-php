<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$vod = $api->vod->all();
var_dump($vod);