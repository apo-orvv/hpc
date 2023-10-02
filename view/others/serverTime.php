<?php
$server_hour = date("H");
$server_minute = date("i");
$hour = $server_hour+5;
$minute = $server_minute+30;
$d = mktime($hour, $minute, 0, 0, 0, 0);
$serverTime= date("H:i", $d);
$H= date("H", $d);
$M= date("i", $d);
?>