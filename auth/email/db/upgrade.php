<?php
//

/**
 * No authentication plugin upgrade code
 *
 * @package    auth_email
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade auth_email.
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_auth_email_upgrade($oldversion) {
    global $CFG, $DB;

    if ($oldversion < 2017020700) {
        // Convert info in config plugins from auth/email to auth_email.
        upgrade_fix_config_auth_plugin_names('email');
        upgrade_fix_config_auth_plugin_defaults('email');
        upgrade_plugin_savepoint(true, 2017020700, 'auth', 'email');
    }

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
