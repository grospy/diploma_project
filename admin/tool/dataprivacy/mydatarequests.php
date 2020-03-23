<?php
//

/**
 * Prints the contact form to the site's Data Protection Officer
 *
 * @copyright 2018 onwards Jun Pataleta
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tool_dataprivacy
 */

require_once("../../../config.php");
require_once('lib.php');

$courseid = optional_param('course', 0, PARAM_INT);

$url = new moodle_url('/admin/tool/dataprivacy/mydatarequests.php');
if ($courseid) {
    $url->param('course', $courseid);
}

$PAGE->set_url($url);

require_login();
if (isguestuser()) {
    print_error('noguest');
}

$usercontext = context_user::instance($USER->id);
$PAGE->set_context($usercontext);

if ($profilenode = $PAGE->settingsnav->find('myprofile', null)) {
    $profilenode->make_active();
}

$title = get_string('datarequests', 'tool_dataprivacy');
$PAGE->navbar->add($title);

// Return URL.
$params = ['id' => $USER->id];
if ($courseid) {
    $params['course'] = $courseid;
}
$returnurl = new moodle_url('/user/profile.php', $params);

$PAGE->set_heading($title);
$PAGE->set_title($title);
echo $OUTPUT->header();
echo $OUTPUT->heading($title);

$requests = tool_dataprivacy\api::get_data_requests($USER->id, [], [], [], 'timecreated DESC');
$requestlist = new tool_dataprivacy\output\my_data_requests_page($requests);
$requestlistoutput = $PAGE->get_renderer('tool_dataprivacy');
echo $requestlistoutput->render($requestlist);

echo $OUTPUT->footer();
