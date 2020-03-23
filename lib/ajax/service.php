<?php
//

/**
 * This file is used to call any registered externallib function in Moodle.
 *
 * It will process more than one request and return more than one response if required.
 * It is recommended to add webservice functions and re-use this script instead of
 * writing any new custom ajax scripts.
 *
 * @since Moodle 2.9
 * @package core
 * @copyright 2015 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);

if (!empty($_GET['nosessionupdate'])) {
    define('NO_SESSION_UPDATE', true);
}

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/externallib.php');

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);

$arguments = '';
$cacherequest = false;
if (defined('ALLOW_GET_PARAMETERS')) {
    $arguments = optional_param('args', '', PARAM_RAW);
    $cachekey = optional_param('cachekey', '', PARAM_INT);
    if ($cachekey && $cachekey > 0 && $cachekey <= time()) {
        $cacherequest = true;
    }
}

// Either we are not allowing GET parameters or we didn't use GET because
// we did not pass a cache key or the URL was too long.
if (empty($arguments)) {
    $arguments = file_get_contents('php://input');
}

$requests = json_decode($arguments, true);

if ($requests === null) {
    $lasterror = json_last_error_msg();
    throw new coding_exception('Invalid json in request: ' . $lasterror);
}
$responses = array();

// Defines the external settings required for Ajax processing.
$settings = external_settings::get_instance();
$settings->set_file('pluginfile.php');
$settings->set_fileurl(true);
$settings->set_filter(true);
$settings->set_raw(false);

$haserror = false;
foreach ($requests as $request) {
    $response = array();
    $methodname = clean_param($request['methodname'], PARAM_ALPHANUMEXT);
    $index = clean_param($request['index'], PARAM_INT);
    $args = $request['args'];

    $response = external_api::call_external_function($methodname, $args, true);
    $responses[$index] = $response;
    if ($response['error']) {
        // Do not process the remaining requests.
        $haserror = true;
        break;
    }
}

if ($cacherequest && !$haserror) {
    // 90 days only - based on Moodle point release cadence being every 3 months.
    $lifetime = 60 * 60 * 24 * 90;

    header('Expires: '. gmdate('D, d M Y H:i:s', time() + $lifetime) .' GMT');
    header('Pragma: ');
    header('Cache-Control: public, max-age=' . $lifetime . ', immutable');
    header('Accept-Ranges: none');
}

echo json_encode($responses);
