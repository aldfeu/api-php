<?php
$api = new \Dacast\Api('YOUR_APIKEY');
$package = $api->package->all();
var_dump($package);