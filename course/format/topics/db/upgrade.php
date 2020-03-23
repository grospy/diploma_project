<?php
//

/**
 * Upgrade scripts for course format "Topics"
 *
 * @package    format_topics
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade script for format_topics
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_format_topics_upgrade($oldversion) {
    global $CFG, $DB;

    require_once($CFG->dirroot . '/course/format/topics/db/upgradelib.php');

    if ($oldversion < 2017020200) {

        // Remove 'numsections' option and hide or delete orphaned sections.
        format_topics_upgrade_remove_numsections();

        upgrade_plugin_savepoint(true, 2017020200, 'format', 'topics');
    }

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2018030900) {

        // During upgrade to Moodle 3.3 it could happen that general section (section 0) became 'invisible'.
        // It should always be visible.
        $DB->execute("UPDATE {course_sections} SET visible=1 WHERE visible=0 AND section=0 AND course IN
        (SELECT id FROM {course} WHERE format=?)", ['topics']);

        upgrade_plugin_savepoint(true, 2018030900, 'format', 'topics');
    }

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
