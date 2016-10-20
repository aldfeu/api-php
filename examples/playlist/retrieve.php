<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$playlist = $api->playlist->all();
var_dump($playlist);