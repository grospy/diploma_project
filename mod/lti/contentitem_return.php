<?php
//

/**
 * Handle the return from the Tool Provider after selecting a content item.
 *
 * @package mod_lti
 * @copyright  2015 Vital Source Technologies http://vitalsource.com
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

$id = required_param('id', PARAM_INT);
$courseid = required_param('course', PARAM_INT);

$jwt = optional_param('JWT', '', PARAM_RAW);

if (!empty($jwt)) {
    $params = lti_convert_from_jwt($id, $jwt);
    $consumerkey = $params['oauth_consumer_key'] ?? '';
    $messagetype = $params['lti_message_type'] ?? '';
    $version = $params['lti_version'] ?? '';
    $items = $params['content_items'] ?? '';
    $errormsg = $params['lti_errormsg'] ?? '';
    $msg = $params['lti_msg'] ?? '';
} else {
    $consumerkey = required_param('oauth_consumer_key', PARAM_RAW);
    $messagetype = required_param('lti_message_type', PARAM_TEXT);
    $version = required_param('lti_version', PARAM_TEXT);
    $items = optional_param('content_items', '', PARAM_RAW);
    $errormsg = optional_param('lti_errormsg', '', PARAM_TEXT);
    $msg = optional_param('lti_msg', '', PARAM_TEXT);
    lti_verify_oauth_signature($id, $consumerkey);
}

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
require_login($course);
require_sesskey();
$context = context_course::instance($courseid);
require_capability('moodle/course:manageactivities', $context);
require_capability('mod/lti:addcoursetool', $context);

$redirecturl = null;
$returndata = null;
if (empty($errormsg) && !empty($items)) {
    try {
        $returndata = lti_tool_configuration_from_content_item($id, $messagetype, $version, $consumerkey, $items);
    } catch (moodle_exception $e) {
        $errormsg = $e->getMessage();
    }
}

$pageurl = new moodle_url('/mod/lti/contentitem_return.php');
$PAGE->set_url($pageurl);
$PAGE->set_pagelayout('popup');
echo $OUTPUT->header();

// Call JS module to redirect the user to the course page or close the dialogue on error/cancel.
$PAGE->requires->js_call_amd('mod_lti/contentitem_return', 'init', [$returndata]);

echo $OUTPUT->footer();

// Add messages to notification stack for rendering later.
if ($errormsg) {
    // Content item selection has encountered an error.
    \core\notification::error($errormsg);

} else if (!empty($returndata)) {
    // Means success.
    if (!$msg) {
        $msg = get_string('successfullyfetchedtoolconfigurationfromcontent', 'lti');
    }
    \core\notification::success($msg);
}
