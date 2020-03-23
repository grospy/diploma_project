<?php
//

/**
 * Admin settings and defaults.
 *
 * @package auth_email
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    // Introductory explanation.
    $settings->add(new admin_setting_heading('auth_email/pluginname', '',
        new lang_string('auth_emaildescription', 'auth_email')));

    $options = array(
        new lang_string('no'),
        new lang_string('yes'),
    );

    $settings->add(new admin_setting_configselect('auth_email/recaptcha',
        new lang_string('auth_emailrecaptcha_key', 'auth_email'),
        new lang_string('auth_emailrecaptcha', 'auth_email'), 0, $options));

    // Display locking / mapping of profile fields.
    $authplugin = get_auth_plugin('email');
    display_auth_lock_options($settings, $authplugin->authtype, $authplugin->userfields,
            get_string('auth_fieldlocks_help', 'auth'), false, false);
}
