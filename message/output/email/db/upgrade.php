<?php
//

/**
 * Upgrade code for email message processor
 *
 * @package    message_email
 * @copyright  2008 Luis Rodrigues
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the email message processor
 *
 * @param int $oldversion The version that we are upgrading from
 */
function xmldb_message_email_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2019032500) {
        // Define table message_email_messages to be created.
        $table = new xmldb_table('message_email_messages');

        // Adding fields to table message_email_messages.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('useridto', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('conversationid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('messageid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table message_email_messages.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('useridto', XMLDB_KEY_FOREIGN, array('useridto'), 'user', array('id'));
        $table->add_key('conversationid', XMLDB_KEY_FOREIGN, array('conversationid'), 'message_conversations', array('id'));
        $table->add_key('messageid', XMLDB_KEY_FOREIGN, array('messageid'), 'messages', array('id'));

        // Conditionally launch create table for message_email_messages.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Savepoint reached.
        upgrade_plugin_savepoint(true, 2019032500, 'message', 'email');
    }

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
