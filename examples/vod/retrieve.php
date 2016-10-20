<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$vod = $api->vod->all();
var_dump($vod);