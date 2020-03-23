<?php
//

/**
 * Allows you to edit a users forum preferences
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

require_once('../config.php');
require_once($CFG->libdir.'/gdlib.php');
require_once($CFG->dirroot.'/user/forum_form.php');
require_once($CFG->dirroot.'/user/editlib.php');
require_once($CFG->dirroot.'/user/lib.php');

$userid = optional_param('id', $USER->id, PARAM_INT);    // User id.
$courseid = optional_param('course', SITEID, PARAM_INT);   // Course id (defaults to Site).

$PAGE->set_url('/user/forum.php', array('id' => $userid, 'course' => $courseid));

list($user, $course) = useredit_setup_preference_page($userid, $courseid);

// Create form.
$forumform = new user_edit_forum_form(null, array('userid' => $user->id));

$user->markasreadonnotification = get_user_preferences('forum_markasreadonnotification', 1, $user->id);
$user->useexperimentalui = get_user_preferences('forum_useexperimentalui', 0, $user->id);
$forumform->set_data($user);

$redirect = new moodle_url("/user/preferences.php", array('userid' => $user->id));
if ($forumform->is_cancelled()) {
    redirect($redirect);
} else if ($data = $forumform->get_data()) {

    $user->maildigest = $data->maildigest;
    $user->autosubscribe = $data->autosubscribe;
    $user->preference_forum_useexperimentalui = $data->useexperimentalui;
    if (!empty($CFG->forum_trackreadposts)) {
        $user->trackforums = $data->trackforums;
        if (property_exists($data, 'markasreadonnotification')) {
            $user->preference_forum_markasreadonnotification = $data->markasreadonnotification;
        }
    }
    unset($user->markasreadonnotification);

    useredit_update_user_preference($user);
    user_update_user($user, false, false);

    // Trigger event.
    \core\event\user_updated::create_from_userid($user->id)->trigger();

    if ($USER->id == $user->id) {
        $USER->maildigest = $data->maildigest;
        $USER->autosubscribe = $data->autosubscribe;
        if (!empty($CFG->forum_trackreadposts)) {
            $USER->trackforums = $data->trackforums;
        }
    }

    redirect($redirect);
}

// Display page header.
$streditmyforum = get_string('forumpreferences');
$userfullname     = fullname($user, true);

$PAGE->navbar->includesettingsbase = true;

$PAGE->set_title("$course->shortname: $streditmyforum");
$PAGE->set_heading($userfullname);

echo $OUTPUT->header();
echo $OUTPUT->heading($streditmyforum);

// Finally display THE form.
$forumform->display();

// And proper footer.
echo $OUTPUT->footer();

