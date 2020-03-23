<?php
//

/**
 * Keeps track of upgrades to the auth_mnet plugin
 *
 * @package    auth_mnet
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade auth_mnet.
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_auth_mnet_upgrade($oldversion) {
    global $CFG;

    if ($oldversion < 2017020700) {
        // Convert info in config plugins from auth/mnet to auth_mnet.
        upgrade_fix_config_auth_plugin_names('mnet');
        upgrade_fix_config_auth_plugin_defaults('mnet');
        upgrade_plugin_savepoint(true, 2017020700, 'auth', 'mnet');
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
