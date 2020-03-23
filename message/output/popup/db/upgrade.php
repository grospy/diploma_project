<?php
//

/**
 * Upgrade code for popup message processor
 *
 * @package   message_popup
 * @copyright 2008 Luis Rodrigues
 * @license   http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the popup message processor
 *
 * @param int $oldversion The version that we are upgrading from
 */
function xmldb_message_popup_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2016122100) {

        // Define index isread (not unique) to be added to message_popup.
        $table = new xmldb_table('message_popup');
        $index = new xmldb_index('isread', XMLDB_INDEX_NOTUNIQUE, array('isread'));

        // Conditionally launch add index isread.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Popup savepoint reached.
        upgrade_plugin_savepoint(true, 2016122100, 'message', 'popup');
    }

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2018032800) {
        // Define table message_popup_notifications to be created.
        $table = new xmldb_table('message_popup_notifications');

        // Adding fields to table message_popup_notifications.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('notificationid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table message_popup_notifications.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('notificationid', XMLDB_KEY_FOREIGN, array('notificationid'), 'notifications', array('id'));

        // Conditionally launch create table for message_popup_notifications.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Popup savepoint reached.
        upgrade_plugin_savepoint(true, 2018032800, 'message', 'popup');
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
