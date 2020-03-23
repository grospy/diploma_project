<?php
//

/**
 * Allows you to edit course preference.
 *
 * @copyright 2016 Joey Andres  <jandres@ualberta.ca>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

require_once(__DIR__ . "/../config.php");
require_once($CFG->dirroot.'/user/editlib.php');

$userid = optional_param('id', $USER->id, PARAM_INT);    // User id.
$courseid = optional_param('course', SITEID, PARAM_INT);   // Course id (defaults to Site).

$PAGE->set_url('/user/course.php', array('id' => $userid, 'course' => $courseid));

list($user, $course) = useredit_setup_preference_page($userid, $courseid);

// Create form.
$courseform = new core_user\course_form(null, array('userid' => $user->id));

$courseform->set_data($user);

$redirect = new moodle_url("/user/preferences.php", array('userid' => $user->id));
if ($courseform->is_cancelled()) {
    redirect($redirect);
} else if ($data = $courseform->get_data()) {
    useredit_update_user_preference(['id' => $user->id,
        'preference_usemodchooser' => $data->enableactivitychooser]);

    redirect($redirect);
}

// Display page header.
$streditmycourse = get_string('coursepreferences');
$userfullname = fullname($user, true);

$PAGE->navbar->includesettingsbase = true;

$PAGE->set_title("$course->shortname: $streditmycourse");
$PAGE->set_heading($userfullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($streditmycourse);

// Finally display THE form.
$courseform->display();

// And proper footer.
echo $OUTPUT->footer();
