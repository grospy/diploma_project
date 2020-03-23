<?php
//

/**
 * Upgrade scirpt for tool_monitor.
 *
 * @package    tool_monitor
 * @copyright  2014 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade the plugin.
 *
 * @param int $oldversion
 * @return bool always true
 */
function xmldb_tool_monitor_upgrade($oldversion) {
    global $CFG, $DB;

    if ($oldversion < 2017021300) {

        // Delete "orphaned" subscriptions.
        $sql = "SELECT DISTINCT s.courseid
                  FROM {tool_monitor_subscriptions} s
       LEFT OUTER JOIN {course} c ON c.id = s.courseid
                 WHERE s.courseid <> 0 and c.id IS NULL";
        $deletedcourses = $DB->get_field_sql($sql);
        if ($deletedcourses) {
            list($sql, $params) = $DB->get_in_or_equal($deletedcourses);
            $DB->execute("DELETE FROM {tool_monitor_subscriptions} WHERE courseid " . $sql, $params);
        }

        // Monitor savepoint reached.
        upgrade_plugin_savepoint(true, 2017021300, 'tool', 'monitor');
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
