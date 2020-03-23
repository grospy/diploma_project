<?php

//

/**
 * Listing of the course administration pages for this course.
 *
 * @copyright 2016 Damyon Wiese
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../config.php");

$courseid = required_param('courseid', PARAM_INT);

$PAGE->set_url('/course/admin.php', array('courseid'=>$courseid));

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

require_login($course);
$context = context_course::instance($course->id);

$PAGE->set_pagelayout('incourse');

if ($courseid == $SITE->id) {
    $title = get_string('frontpagesettings');
    $node = $PAGE->settingsnav->find('frontpage', navigation_node::TYPE_SETTING);
} else {
    $title = get_string('courseadministration');
    $node = $PAGE->settingsnav->find('courseadmin', navigation_node::TYPE_COURSE);
}
$PAGE->set_title($title);
$PAGE->set_heading($course->fullname);
$PAGE->navbar->add($title);
echo $OUTPUT->header();
echo $OUTPUT->heading($title);

if ($node) {
    echo $OUTPUT->render_from_template('core/settings_link_page', ['node' => $node]);
}

echo $OUTPUT->footer();
