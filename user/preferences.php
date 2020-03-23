<?php
//

/**
 * Preferences.
 *
 * @package    core_user
 * @copyright  2015 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/navigationlib.php');

require_login(null, false);
if (isguestuser()) {
    throw new require_login_exception('Guests are not allowed here.');
}

$userid = optional_param('userid', $USER->id, PARAM_INT);
$currentuser = $userid == $USER->id;

// Check that the user is a valid user.
$user = core_user::get_user($userid);
if (!$user || !core_user::is_real_user($userid)) {
    throw new moodle_exception('invaliduser', 'error');
}

$PAGE->set_context(context_user::instance($userid));
$PAGE->set_url('/user/preferences.php', array('userid' => $userid));
$PAGE->set_pagelayout('admin');
$PAGE->set_pagetype('user-preferences');
$PAGE->set_title(get_string('preferences'));
$PAGE->set_heading(fullname($user));

if (!$currentuser) {
    $PAGE->navigation->extend_for_user($user);
    // Need to check that settings exist.
    if ($settings = $PAGE->settingsnav->find('userviewingsettings' . $user->id, null)) {
        $settings->make_active();
    }
    $url = new moodle_url('/user/preferences.php', array('userid' => $userid));
    $navbar = $PAGE->navbar->add(get_string('preferences', 'moodle'), $url);
    // Show an error if there are no preferences that this user has access to.
    if (!$PAGE->settingsnav->can_view_user_preferences($userid)) {
        throw new moodle_exception('cannotedituserpreferences', 'error');
    }
} else {
    // Shutdown the users node in the navigation menu.
    $usernode = $PAGE->navigation->find('users', null);
    $usernode->make_inactive();

    $settings = $PAGE->settingsnav->find('usercurrentsettings', null);
    $settings->make_active();
}

// Identifying the nodes.
$groups = array();
$orphans = array();
foreach ($settings->children as $setting) {
    if ($setting->has_children()) {
        $groups[] = new preferences_group($setting->get_content(), $setting->children);
    } else {
        $orphans[] = $setting;
    }
}
if (!empty($orphans)) {
    $groups[] = new preferences_group(get_string('miscellaneous'), $orphans);
}
$preferences = new preferences_groups($groups);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('preferences'));
echo $OUTPUT->render($preferences);
echo $OUTPUT->footer();
