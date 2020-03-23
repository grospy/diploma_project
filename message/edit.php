<?php
//

/**
 * Edit user message preferences
 *
 * @package    core_message
 * @copyright  2008 Luis Rodrigues and Martin Dougiamas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/message/lib.php');
require_once($CFG->dirroot . '/user/lib.php');

$userid = optional_param('id', 0, PARAM_INT);    // User id.
$currentuser = true;

if (!$userid) {
    $userid = $USER->id;
}

$url = new moodle_url('/message/edit.php');
$url->param('id', $userid);

$PAGE->set_url($url);

require_login();

if (isguestuser()) {
    print_error('guestnoeditmessage', 'message');
}

if (!$user = $DB->get_record('user', array('id' => $userid))) {
    print_error('invaliduserid');
}

$systemcontext   = context_system::instance();
$personalcontext = context_user::instance($user->id);

$PAGE->set_context($personalcontext);
$PAGE->set_pagelayout('admin');

// check access control
if ($user->id == $USER->id) {
    //editing own message profile
    require_capability('moodle/user:editownmessageprofile', $systemcontext);
} else {
    $currentuser = false;
    // teachers, parents, etc.
    require_capability('moodle/user:editmessageprofile', $personalcontext);
    // no editing of guest user account
    if (isguestuser($user->id)) {
        print_error('guestnoeditmessageother', 'message');
    }
    // no editing of admins by non admins!
    if (is_siteadmin($user) and !is_siteadmin($USER)) {
        print_error('useradmineditadmin');
    }
    $PAGE->navbar->includesettingsbase = true;
    $PAGE->navigation->extend_for_user($user);
}

/// Display page header
$strmessaging = get_string('messagepreferences', 'message');
$PAGE->set_title($strmessaging);
$PAGE->set_heading(fullname($user));

echo $OUTPUT->header();
if ($currentuser) {
    // Open the message drawer to show the settings.
    echo $OUTPUT->heading(get_string('messagepreferences', 'core_message'));
    $PAGE->requires->js_call_amd('core_message/message_drawer_helper', 'showSettings');
} else {
    // Viewing another user's preferences so render the old page.
    $renderer = $PAGE->get_renderer('core', 'message');
    echo $renderer->render_user_message_preferences($user);
}

echo $OUTPUT->footer();

