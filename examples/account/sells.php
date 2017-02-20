<?php
$api = new \Dacast\Api('YOUR_DACAST_API');
$account = $api->account->sells();
var_dump($account);