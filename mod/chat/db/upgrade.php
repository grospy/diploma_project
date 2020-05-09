<?php
//

/**
 * Upgrade code for the chat activity
 *
 * @package   mod_chat
 * @copyright 2006 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_chat_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2017111301) {
        // Rename field 'system' on table 'chat_messages' as it is a reserved word in MySQL 8+.
        $table = new xmldb_table('chat_messages');
        $field = new xmldb_field('system');
        if ($dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'groupid');
            // Extend the execution time limit of the script to 2 hours.
            upgrade_set_timeout(7200);
            // Rename it to 'issystem'.
            $dbman->rename_field($table, $field, 'issystem');
        }

        // Rename field 'system' on table 'chat_messages_current' as it is a reserved word in MySQL 8+.
        $table = new xmldb_table('chat_messages_current');
        $field = new xmldb_field('system');
        if ($dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'groupid');
            // Extend the execution time limit of the script to 5 minutes.
            upgrade_set_timeout(300);
            // Rename it to 'issystem'.
            $dbman->rename_field($table, $field, 'issystem');
        }

        // Savepoint reached.
        upgrade_mod_savepoint(true, 2017111301, 'chat');
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