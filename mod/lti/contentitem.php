<?php
//

/**
 * Handle sending a user to a tool provider to initiate a content-item selection.
 *
 * @package mod_lti
 * @copyright  2015 Vital Source Technologies http://vitalsource.com
 * @author     Stephen Vickers
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/mod/lti/lib.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

$id = required_param('id', PARAM_INT);
$courseid = required_param('course', PARAM_INT);
$title = optional_param('title', '', PARAM_TEXT);
$text = optional_param('text', '', PARAM_RAW);

$config = lti_get_type_type_config($id);
if ($config->lti_ltiversion === LTI_VERSION_1P3) {
    if (!isset($SESSION->lti_initiatelogin_status)) {
        echo lti_initiate_login($courseid, 0, null, $config, 'ContentItemSelectionRequest', $title, $text);
        exit;
    } else {
        unset($SESSION->lti_initiatelogin_status);
    }
}

// Check access and capabilities.
$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
require_login($course);
$context = context_course::instance($courseid);
require_capability('moodle/course:manageactivities', $context);
require_capability('mod/lti:addcoursetool', $context);

// Set the return URL. We send the launch container along to help us avoid frames-within-frames when the user returns.
$returnurlparams = [
    'course' => $course->id,
    'id' => $id,
    'sesskey' => sesskey()
];
$returnurl = new \moodle_url('/mod/lti/contentitem_return.php', $returnurlparams);

// Prepare the request.
$request = lti_build_content_item_selection_request($id, $course, $returnurl, $title, $text, [], []);

// Get the launch HTML.
$content = lti_post_launch_html($request->params, $request->url, false);

echo $content;
