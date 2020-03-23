<?php
//
//

/**
 * This file keeps track of upgrades to the lti enrolment plugin
 *
 * @package enrol_lti
 * @copyright  2016 John Okely <john@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die;

/**
 * xmldb_lti_upgrade is the function that upgrades
 * the lti module database when is needed
 *
 * This function is automaticly called when version number in
 * version.php changes.
 *
 * @param int $oldversion New old version number.
 *
 * @return boolean
 */
function xmldb_enrol_lti_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2017011300) {

        // Changing precision of field value on table enrol_lti_lti2_nonce to (64).
        $table = new xmldb_table('enrol_lti_lti2_nonce');
        $field = new xmldb_field('value', XMLDB_TYPE_CHAR, '64', null, XMLDB_NOTNULL, null, null, 'consumerid');

        // Launch change of precision for field value.
        $dbman->change_field_precision($table, $field);

        // Lti savepoint reached.
        upgrade_plugin_savepoint(true, 2017011300, 'enrol', 'lti');
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
