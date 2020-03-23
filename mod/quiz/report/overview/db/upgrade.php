<?php
//

/**
 * Quiz overview report upgrade script.
 *
 * @package   quiz_overview
 * @copyright 2008 Jamie Pratt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Quiz overview report upgrade function.
 * @param number $oldversion
 */
function xmldb_quiz_overview_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Upgrade 2018021800 (now removed) incorrectly added this key
    // with a unique constraint, which breaks things because those
    // columns are not, in fact, unique. So drop (if it exists) then recreate.
    if ($oldversion < 2018061800) {

        // Define key questionusageid-slot (foreign) to be dropped form quiz_overview_regrades.
        $table = new xmldb_table('quiz_overview_regrades');

        // There is no key_exists, so test the equivalent index.
        $oldindex = new xmldb_index('questionusageid-slot', XMLDB_KEY_UNIQUE, array('questionusageid', 'slot'));

        // Launch drop key questionusageid-slot.
        if ($dbman->index_exists($table, $oldindex)) {
            $key = new xmldb_key('questionusageid-slot', XMLDB_KEY_FOREIGN, array('questionusageid', 'slot'), 'question_attempts', array('questionusageid', 'slot'));
            $dbman->drop_key($table, $key);
        }

        // Overview savepoint reached.
        upgrade_plugin_savepoint(true, 2018061800, 'quiz', 'overview');
    }

    if ($oldversion < 2018061801) {

        // Define key questionusageid-slot (foreign) to be added to quiz_overview_regrades.
        $table = new xmldb_table('quiz_overview_regrades');
        $key = new xmldb_key('questionusageid-slot', XMLDB_KEY_FOREIGN, array('questionusageid', 'slot'), 'question_attempts', array('questionusageid', 'slot'));

        // Launch add key questionusageid-slot.
        $dbman->add_key($table, $key);

        // Overview savepoint reached.
        upgrade_plugin_savepoint(true, 2018061801, 'quiz', 'overview');
    }

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
