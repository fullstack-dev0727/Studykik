<?php
# Database Configuration
define( 'DB_NAME', 'wp_studykik' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'rootroot' );
define( 'DB_HOST', 'studykik.cgba6dkbfcoo.us-east-1.rds.amazonaws.com' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = '0gf1ba_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '[F|(`H,R$m06.Pv,k%%q$N|9RRDUw{`S.|9?J~vCUoHY0|>uhN5RHWf];EcuKD65');
define('SECURE_AUTH_KEY',  '<v-?t]Km386X&8!p2Q{tnaKP1T>(W3bH|bU2XtFT/;p?|#RExJI|D1cw?}O<5&c6');
define('LOGGED_IN_KEY',    '1bn+)YId`g$/^^};Pck}>N+CED-=uJOs0}?<ZyEIa}j`Cmb+|s!E@IT$A(S1N#=[');
define('NONCE_KEY',        ' rjxe&3I5FmNMpUo<FoWef%v.[o.JA|/?^ {ZK(JK>Zm|8A,Q+{uQ7O=l{NTrxa-');
define('AUTH_SALT',        'yq<ajoF#/<zJ4{(654C[&>=-({S0.^AZ-oEF)_|QS2BbG+t5hF3c0:adT_BM<7P+');
define('SECURE_AUTH_SALT', 'aDy)gN<Vb;ZY[]?n,+ Q_&=WHr>nP]42nz:TfgW-/-9~mN0pfOWB6gkFE<DA39iG');
define('LOGGED_IN_SALT',   'z.luXGy+F-3g){%1 D2,q$XWKMn)CQI)+e+GS(6?Im-%n5-RXB7%/9r<CY (|;kF');
define('NONCE_SALT',       'o&P_3-h}q$6Y1Du+}~r_(N/e~{.2UNWzCrBSCcCG>:Ir46g->&wr8-H-K%OymBz2');

$connnt=mysql_connect("studykik.cgba6dkbfcoo.us-east-1.rds.amazonaws.com",DB_USER,DB_PASSWORD);
mysql_select_db('wp_studykik');




define('W3TC_EDGE_MODE', true);
define('WP_MEMORY_LIMIT', '512M');
define('WP_DEBUG', false);


# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
$_wpe_preamble_path = null; if(false){}
if(isset($_GET['listname'])){
    unset($_GET['name']);
}