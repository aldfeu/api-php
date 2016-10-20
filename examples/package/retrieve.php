<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$package = $api->package->all();
var_dump($package);