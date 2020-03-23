<?php
//

/**
 * This file returns an array of available public keys
 *
 * @package    mod_lti
 * @copyright  2019 Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_DEBUG_DISPLAY', true);
define('NO_MOODLE_COOKIES', true);

require_once(__DIR__ . '/../../config.php');

$jwks = array('keys' => array());

$privatekey = get_config('mod_lti', 'privatekey');
$res = openssl_pkey_get_private($privatekey);
$details = openssl_pkey_get_details($res);

$jwk = array();
$jwk['kty'] = 'RSA';
$jwk['alg'] = 'RS256';
$jwk['kid'] = get_config('mod_lti', 'kid');
$jwk['e'] = rtrim(strtr(base64_encode($details['rsa']['e']), '+/', '-_'), '=');
$jwk['n'] = rtrim(strtr(base64_encode($details['rsa']['n']), '+/', '-_'), '=');
$jwk['use'] = 'sig';

$jwks['keys'][] = $jwk;

@header('Content-Type: application/json; charset=utf-8');

echo json_encode($jwks, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
