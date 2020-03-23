<?php
//


/**
 * SOAP web service entry point. The authentication is done via tokens.
 *
 * @package    webservice_soap
 * @copyright  2009 Jerome Mouneyrac
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * NO_DEBUG_DISPLAY - disable moodle specific debug messages and any errors in output
 */
define('NO_DEBUG_DISPLAY', true);

define('WS_SERVER', true);

require('../../config.php');
require_once("$CFG->dirroot/webservice/soap/locallib.php");

if (!webservice_protocol_is_enabled('soap')) {
    debugging('The server died because the web services or the SOAP protocol are not enable',
        DEBUG_DEVELOPER);
    die;
}

$server = new webservice_soap_server(WEBSERVICE_AUTHMETHOD_PERMANENT_TOKEN);
$server->run();
die;

