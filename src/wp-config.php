<?php
/**
 * WordPress config
 */

$hostnames = (object) [
	'local' => 'local.domain.com',
	'test' => 'test.domain.com',
	'live' => 'www.domain.com'
];

$hostname = $_SERVER['SERVER_NAME'];
$search = !empty($hostname)? $hostname : __FILE__;

// Check environment
$isProduction = !!preg_match("/{$hostnames->test}|{$hostnames->live}/", $search);
$isDebug = !!preg_match("/{$hostnames->test}|{$hostnames->local}|core-wordpress/", $search);

// Set hostname manually for command line
if (empty($hostname)) {

	if ($isProduction) {
		$hostname = $isDebug? $hostnames->test : $hostnames->live;
	}

	// Otherwise presume local
	else $hostname = $hostnames->local;

	// Update globals, avoid plugin warnings
	$_SERVER['SERVER_NAME'] = $hostname;
	$_SERVER['HTTP_HOST'] = $hostname;
	$_SERVER['REQUEST_URI'] = '/';
	$_SERVER['REQUEST_METHOD'] = null;
	$_SERVER['SERVER_PORT'] = null;
}

// Get hostname from server
else $hostname = $_SERVER['SERVER_NAME'];

// Toggle debug mode
define('WP_DEBUG', $isDebug);
define('WP_DEBUG_DISPLAY', false);

/**
 * Database connection.
 */
define('DB_USER', 'core');
define('DB_PASSWORD', 'change-me-1234');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8_general_ci');
define('DB_HOST', 'localhost');
define('DB_NAME', 'core');

$table_prefix  = 'wp_';

/**
 * Authentication Unique Keys and Salts.
 */
define('AUTH_KEY',         '9g=M+Td.%{aZT.wEHq60Rd%q#__>Y2xhHF22:DtrM,ji~n2FyccNF^h+.Y%]-|WM');
define('SECURE_AUTH_KEY',  '!)rr6_$;C^Etx~^ebQUZiN.u8<ADBiyG]wyJCD<smPcF8]+zY``d)XFUB37&]^j^');
define('LOGGED_IN_KEY',    '!powmM`I2nc.aBvMvUa4,!U7IoSTC}Kde,i+{2U3<+`%Uao8/ ]B{*|/<<gA*NCJ');
define('NONCE_KEY',        ']=|K*6.ngxY!~<])lgb^)6cS.uMVETUg+bNm8M1p[o0?<?Y[U(dt_Q_1I/Lipbm!');
define('AUTH_SALT',        '0<R@q6z,n0g`?ql;J4`6QRc!@Y)wf]d<~3ch>i00|M,uyf4Dqq`sK.uxUh[Zxs*$');
define('SECURE_AUTH_SALT', 'w%h2>1c[BCK<uCb<w~6@OxI&k}c jV_cclC#zxX}izl1f]>rVP)g2 r+<#1q$}:&');
define('LOGGED_IN_SALT',   '66.d3(Ht!|8=nLBcq^TQ1 4UGY>;~3u@>_tUS$?J]=63TG`ZQX^ws<(`WY{+R+c`');
define('NONCE_SALT',       'UGrH>s}+)`mPFX8991|mpQP.iD[9eNJ?$YU-Pbq+5fg^~u</HlvGJ2Q7a9]m2]QD');


/**
 * Switch to SSL
 */
$isSSL = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
$isSSLForwarded = !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';

if ($isSSL || $isSSLForwarded)
	$_SERVER['HTTPS'] = 'on';

/** Override hostnames for live/local */
$scheme = $isSSL || $isSSLForwarded? 'https://' : 'http://';

/**
 * Language etc
 */
define('WPLANG', 'en_GB');
define('WP_SITEURL', "{$scheme}{$hostname}/wordpress");
define('WP_HOME', "{$scheme}{$hostname}");
define('WP_CONTENT_URL', "{$scheme}{$hostname}/content");
define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
define('WP_POST_REVISIONS', false);
define('DISALLOW_FILE_EDIT', true);

/** WP Super Cache **/
define('WPCACHEHOME', ABSPATH . '../content/plugins/wp-super-cache/');
define('WP_CACHE', true);

/** Sets up WordPress vars and included files. */
require_once('vendor/autoload.php');
require_once(ABSPATH . 'wp-settings.php');
