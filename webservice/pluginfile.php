<?php
//


/**
 * A script to serve files from web service client
 *
 * @package    core_webservice
 * @copyright  2011 Dongsheng Cai <dongsheng@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * AJAX_SCRIPT - exception will be converted into JSON
 */
define('AJAX_SCRIPT', true);

/**
 * NO_MOODLE_COOKIES - we don't want any cookie
 */
define('NO_MOODLE_COOKIES', true);


require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->dirroot . '/webservice/lib.php');

// Allow CORS requests.
header('Access-Control-Allow-Origin: *');

// Authenticate the user.
$token = required_param('token', PARAM_ALPHANUM);
// Use preview in order to display the preview of the file (e.g. "thumb" for a thumbnail).
$preview = optional_param('preview', null, PARAM_ALPHANUM);
// Offline means download the file from the repository and serve it, even if it was an external link.
// The repository may have to export the file to an offline format.
$offline = optional_param('offline', 0, PARAM_BOOL);

$webservicelib = new webservice();
$authenticationinfo = $webservicelib->authenticate_user($token);

// Check the service allows file download.
$enabledfiledownload = (int) ($authenticationinfo['service']->downloadfiles);
if (empty($enabledfiledownload)) {
    throw new webservice_access_exception('Web service file downloading must be enabled in external service settings');
}

// Finally we can serve the file :).
$relativepath = get_file_argument();
file_pluginfile($relativepath, 0, $preview, $offline);
