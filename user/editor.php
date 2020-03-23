<?php
//

/**
 * Allows you to edit a users editor preferences
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

require_once('../config.php');
require_once($CFG->libdir.'/gdlib.php');
require_once($CFG->dirroot.'/user/editor_form.php');
require_once($CFG->dirroot.'/user/editlib.php');
require_once($CFG->dirroot.'/user/lib.php');

$userid = optional_param('id', $USER->id, PARAM_INT);    // User id.
$courseid = optional_param('course', SITEID, PARAM_INT);   // Course id (defaults to Site).

$PAGE->set_url('/user/editor.php', array('id' => $userid, 'course' => $courseid));

list($user, $course) = useredit_setup_preference_page($userid, $courseid);

// Create form.
$editorform = new user_edit_editor_form();

$user->preference_htmleditor = get_user_preferences( 'htmleditor', '', $user->id);
$editorform->set_data($user);

$redirect = new moodle_url("/user/preferences.php", array('userid' => $user->id));
if ($editorform->is_cancelled()) {
    redirect($redirect);
} else if ($data = $editorform->get_data()) {

    $user->preference_htmleditor = $data->preference_htmleditor;

    useredit_update_user_preference($user);
    // Trigger event.
    \core\event\user_updated::create_from_userid($user->id)->trigger();

    redirect($redirect);
}

// Display page header.
$streditmyeditor = get_string('editorpreferences');
$userfullname     = fullname($user, true);

$PAGE->navbar->includesettingsbase = true;

$PAGE->set_title("$course->shortname: $streditmyeditor");
$PAGE->set_heading($userfullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($streditmyeditor);

// Finally display THE form.
$editorform->display();

// And proper footer.
echo $OUTPUT->footer();

