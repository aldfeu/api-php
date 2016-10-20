<?php
$api = new \Dacast\Api('65041_5e0e9cca5dcda8e8b36a');
$playlist = $api->playlist->all();
var_dump($playlist);