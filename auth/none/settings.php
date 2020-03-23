<?php
//

/**
 * Admin settings and defaults.
 *
 * @package auth_none
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Introductory explanation.
    $settings->add(new admin_setting_heading('auth_none/pluginname', '',
        new lang_string('auth_nonedescription', 'auth_none')));

    // Display locking / mapping of profile fields.
    $authplugin = get_auth_plugin('none');
    display_auth_lock_options($settings, $authplugin->authtype, $authplugin->userfields,
        get_string('auth_fieldlocks_help', 'auth'), false, false);
}
