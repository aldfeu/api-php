<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$channel = $api->live->all();
var_dump($channel);