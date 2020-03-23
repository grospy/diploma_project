<?php
//

/**
 * Change a users email address
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/user/editlib.php');
require_once($CFG->dirroot.'/user/lib.php');

$key = required_param('key', PARAM_ALPHANUM);
$id  = required_param('id', PARAM_INT);

$PAGE->set_url('/user/emailupdate.php', array('id' => $id, 'key' => $key));
$PAGE->set_context(context_system::instance());

if (!$user = $DB->get_record('user', array('id' => $id))) {
    print_error('invaliduserid');
}

$preferences = get_user_preferences(null, null, $user->id);
$a = new stdClass();
$a->fullname = fullname($user, true);
$stremailupdate = get_string('emailupdate', 'auth', $a);

$PAGE->set_title(format_string($SITE->fullname) . ": $stremailupdate");
$PAGE->set_heading(format_string($SITE->fullname) . ": $stremailupdate");

if (empty($preferences['newemailattemptsleft'])) {
    redirect("$CFG->wwwroot/user/view.php?id=$user->id");

} else if ($preferences['newemailattemptsleft'] < 1) {
    cancel_email_update($user->id);

    echo $OUTPUT->header();
    echo $OUTPUT->box(get_string('auth_outofnewemailupdateattempts', 'auth'), 'center');
    echo $OUTPUT->footer();
} else if ($key == $preferences['newemailkey']) {
    $olduser = clone($user);
    cancel_email_update($user->id);
    $user->email = $preferences['newemail'];

    // Detect duplicate before saving.
    if (empty($CFG->allowaccountssameemail)) {
        // Make a case-insensitive query for the given email address.
        $select = $DB->sql_equal('email', ':email', false) . ' AND mnethostid = :mnethostid AND id <> :userid';
        $params = array(
            'email' => $user->email,
            'mnethostid' => $CFG->mnet_localhost_id,
            'userid' => $user->id
        );
        // If there are other user(s) that already have the same email, cancel and redirect.
        if ($DB->record_exists_select('user', $select, $params)) {
            redirect(new moodle_url('/user/view.php', ['id' => $user->id]), get_string('emailnowexists', 'auth'));
        }
    }

    // Update user email.
    $authplugin = get_auth_plugin($user->auth);
    $authplugin->user_update($olduser, $user);
    user_update_user($user, false);
    $a->email = $user->email;
    redirect(
        new moodle_url('/user/view.php', ['id' => $user->id]),
        get_string('emailupdatesuccess', 'auth', $a),
        null,
        \core\output\notification::NOTIFY_SUCCESS
    );

} else {
    $preferences['newemailattemptsleft']--;
    set_user_preference('newemailattemptsleft', $preferences['newemailattemptsleft'], $user->id);
    echo $OUTPUT->header();
    echo $OUTPUT->box(get_string('auth_invalidnewemailkey', 'auth'), 'center');
    echo $OUTPUT->footer();
}
