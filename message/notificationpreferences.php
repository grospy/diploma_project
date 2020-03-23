<?php
//

/**
 * Edit user notification preferences
 *
 * @package    core_message
 * @copyright  2016 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/message/lib.php');
require_once($CFG->dirroot . '/user/lib.php');

$userid = optional_param('userid', $USER->id, PARAM_INT);    // User id.
$url = new moodle_url('/message/notificationpreferences.php');
$url->param('userid', $userid);

$PAGE->set_url($url);

require_login();

if (isguestuser()) {
    print_error('guestnoeditmessage', 'message');
}

$user = $DB->get_record('user', array('id' => $userid), '*', MUST_EXIST);

$systemcontext   = context_system::instance();
$personalcontext = context_user::instance($user->id);

$PAGE->set_context($personalcontext);
$PAGE->set_pagelayout('admin');

// Check access control.
if ($user->id == $USER->id) {
    // Editing own message profile.
    require_capability('moodle/user:editownmessageprofile', $systemcontext);
} else {
    // Teachers, parents, etc.
    require_capability('moodle/user:editmessageprofile', $personalcontext);
    // No editing of guest user account.
    if (isguestuser($user->id)) {
        print_error('guestnoeditmessageother', 'message');
    }
    // No editing of admins by non admins!
    if (is_siteadmin($user) and !is_siteadmin($USER)) {
        print_error('useradmineditadmin');
    }
    $PAGE->navbar->includesettingsbase = true;
    $PAGE->navigation->extend_for_user($user);
}

// Display page header.
$strmessaging = get_string('notificationpreferences', 'message');
$PAGE->set_title($strmessaging);
$PAGE->set_heading(fullname($user));

// Grab the renderer.
$renderer = $PAGE->get_renderer('core', 'message');
$messagingoptions = $renderer->render_user_notification_preferences($user);

echo $OUTPUT->header();
echo $messagingoptions;
echo $OUTPUT->footer();

