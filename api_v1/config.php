<?php
# Database Configuration
define( 'DB_NAME', 'studykik' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'ecao7jne' );
define( 'DB_HOST', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = '0gf1ba_';

define('username_api', 'suvoda');
define('password_api', 'suvodatest');

$db = @mysql_connect("127.0.0.1",DB_USER,DB_PASSWORD);
mysql_select_db(DB_NAME);

function pc_validate($user,$pass) {
    if ($user == username_api && $pass == password_api) {
        return true;
    } else {
        return false;
    }
}