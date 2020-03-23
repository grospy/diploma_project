<?php
//


/**
 * REST web service entry point. The authentication is done via username/password.
 *
 * @package    webservice_rest
 * @copyright  2009 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * NO_DEBUG_DISPLAY - disable moodle specific debug messages and any errors in output
 */
define('NO_DEBUG_DISPLAY', true);

define('WS_SERVER', true);

require('../../config.php');
require_once("$CFG->dirroot/webservice/rest/locallib.php");

if (!webservice_protocol_is_enabled('rest')) {
    die;
}

$server = new webservice_rest_server(WEBSERVICE_AUTHMETHOD_USERNAME);
$server->run();
die;


