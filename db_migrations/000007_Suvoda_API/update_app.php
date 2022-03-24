<?php
error_reporting( E_ERROR );
# Database Configuration
define( 'DB_NAME', 'studykik_staging' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'rootroot' );
define( 'DB_HOST', 'studykik.cgba6dkbfcoo.us-east-1.rds.amazonaws.com' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = '0gf1ba_';

$connnt=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_NAME);

while(count(getPart()) != 0){
    $part_arr = getPart();

    foreach($part_arr as $part){
        mysql_query("UPDATE 0gf1ba_subscriber_list SET clear_phone='".editPhoneNumber($part['phone'])."' WHERE id='".$part['id']."';");
    }
}

function editPhoneNumber($phone){
    return preg_replace("/[^0-9]+/", '', $phone);
}

function getPart(){
    $res = array();
    $mysql_result = mysql_query('SELECT * FROM `0gf1ba_subscriber_list` WHERE `clear_phone` IS NULL LIMIT 50;');

    while ($r = mysql_fetch_assoc($mysql_result)) {
        $res[] = $r;
    }

    mysql_free_result($mysql_result);
    return $res;
}