<?php
//

/**
 * Numerical question type upgrade code.
 *
 * @package    qtype
 * @subpackage numerical
 * @copyright  1999 onwards Martin Dougiamas {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade code for the numerical question type.
 * @param int $oldversion the version we are upgrading from.
 */
function xmldb_qtype_numerical_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.4.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2017121000) {

        // Changing length of field multiplier on table question_numerical_units to 38.
        $table = new xmldb_table('question_numerical_units');
        $field = new xmldb_field('multiplier', XMLDB_TYPE_NUMBER, '38, 19', null, XMLDB_NOTNULL, null, '1.00000000000000000000');

        // Launch change of length for field multiplier.
        $dbman->change_field_type($table, $field);

        // Data savepoint reached.
        upgrade_plugin_savepoint(true, 2017121000, 'qtype', 'numerical');
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
