<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$playlist = $api->playlist->all();
var_dump($playlist);