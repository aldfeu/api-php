<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$package = $api->package->all();
var_dump($package);