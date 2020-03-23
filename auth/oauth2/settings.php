<?php
//

/**
 * Admin settings and defaults.
 *
 * @package auth_oauth2
 * @copyright  2017 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $warning = $OUTPUT->notification(get_string('createaccountswarning', 'auth_oauth2'), 'warning');
    $settings->add(new admin_setting_heading('auth_oauth2/pluginname', '', $warning));

    $authplugin = get_auth_plugin('oauth2');
    display_auth_lock_options($settings, $authplugin->authtype, $authplugin->userfields,
            get_string('auth_fieldlocks_help', 'auth'), false, false);
}
