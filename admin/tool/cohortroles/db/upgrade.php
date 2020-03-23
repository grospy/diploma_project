<?php
//

/**
 * Plugin upgrade code
 *
 * @package    tool_cohortroles
 * @copyright  2020 Paul Holden <paulh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade tool_cohortroles.
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_tool_cohortroles_upgrade($oldversion) {
    global $DB;

    if ($oldversion < 2019111801) {
        // Delete any tool_cohortroles mappings for roles which no longer exist.
        $DB->delete_records_select('tool_cohortroles', 'roleid NOT IN (SELECT id FROM {role})');

        // Cohortroles savepoint reached.
        upgrade_plugin_savepoint(true, 2019111801, 'tool', 'cohortroles');
    }

    return true;
}
