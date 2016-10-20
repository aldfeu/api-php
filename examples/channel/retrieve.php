<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$channel = $api->live->all();
var_dump($channel);