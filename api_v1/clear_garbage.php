<?php
require_once "config.php";

removeExpiredTokens();

echo 'END';

function removeExpiredTokens(){
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $sql = 'DELETE FROM 0gf1ba_api_tokens WHERE expire_dt < \''.$now->format('Y-m-d H:i:s').'\' ';
    mysql_query($sql);
}