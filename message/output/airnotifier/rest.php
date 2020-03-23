<?php
//

/**
 * Provide interface for AJAX device actions
 *
 * @copyright 2012 Jerome Mouneyrac
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package message_airnotifier
 */


define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../../config.php');

// Initialise ALL the incoming parameters here, up front.
$id         = required_param('id', PARAM_INT);
$enable     = required_param('enable', PARAM_BOOL);

require_login();
require_sesskey();

$systemcontext = context_system::instance();

$PAGE->set_url('/message/output/airnotifier/rest.php');
$PAGE->set_context($systemcontext);

require_capability('message/airnotifier:managedevice', $systemcontext);

echo $OUTPUT->header();

// Response class to be converted to json string.
$response = new stdClass();

if (!message_airnotifier_manager::enable_device($id, $enable)) {
    throw new moodle_exception('unknowndevice', 'message_airnotifier');
}

$response->success = true;
echo json_encode($response);
die;