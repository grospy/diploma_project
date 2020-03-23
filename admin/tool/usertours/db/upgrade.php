<?php
//

/**
 * Upgrade code for install
 *
 * @package   tool_usertours
 * @copyright 2016 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tool_usertours\manager;

/**
 * Upgrade the user tours plugin.
 *
 * @param int $oldversion The old version of the user tours plugin
 * @return bool
 */
function xmldb_tool_usertours_upgrade($oldversion) {
    global $CFG, $DB;

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2018113002) {
        // Update the tours shipped with Moodle.
        manager::update_shipped_tours();

        upgrade_plugin_savepoint(true, 2018113002, 'tool', 'usertours');
    }

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2019030600) {
        // Update the tours shipped with Moodle.
        manager::update_shipped_tours();

        upgrade_plugin_savepoint(true, 2019030600, 'tool', 'usertours');
    }

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
