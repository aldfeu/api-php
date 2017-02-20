<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$accountSells = $api->account->sells();
var_dump($accountSells);
