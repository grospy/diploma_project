<?php
//


/**
 * XML-RPC web service entry point. The authentication is done via username/password.
 *
 * @package    webservice_xmlrpc
 * @copyright  2009 Petr Skodak
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * NO_DEBUG_DISPLAY - disable moodle specific debug messages and any errors in output
 */
define('NO_DEBUG_DISPLAY', true);

define('WS_SERVER', true);

require('../../config.php');
require_once("$CFG->dirroot/webservice/xmlrpc/locallib.php");

if (!webservice_protocol_is_enabled('xmlrpc')) {
    die;
}

$server = new webservice_xmlrpc_server(WEBSERVICE_AUTHMETHOD_USERNAME);
$server->run();
die;


