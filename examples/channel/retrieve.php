<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$channel = $api->live->all();
var_dump($channel);