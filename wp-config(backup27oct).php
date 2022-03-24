<?php
# Database Configuration
define( 'DB_NAME', 'wp_studykik' );
define( 'DB_USER', 'studykik' );
define( 'DB_PASSWORD', 'ub2KeB9XDG1qKuB0asdQ' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
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
$connnt=mysql_connect("127.0.0.1","studykik","ub2KeB9XDG1qKuB0asdQ");
mysql_select_db('wp_studykik');

# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'studykik' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '4df19be11d1296e138ed670dd18c13e533581120' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '42861' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '198.58.116.35' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'studykik.com', 1 => 'www.studykik.com', 2 => 'studykik.wpengine.com', 3 => 'callloop_list_id', );

$wpe_varnish_servers=array ( 0 => 'pod-42861', );

$wpe_special_ips=array ( 0 => '198.58.116.35', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






define('W3TC_EDGE_MODE', true);
define('WP_MEMORY_LIMIT', '512M');
define('WP_DEBUG', false);


# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
