<?php
//

/**
 * Label module upgrade
 *
 * @package mod_label
 * @copyright  2006 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This file keeps track of upgrades to
// the label module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

defined('MOODLE_INTERNAL') || die;

function xmldb_label_upgrade($oldversion) {
    global $CFG, $DB;

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2017062800) {
        // Update all records in 'course_modules' for labels to have showdescription = 1.
        if ($modid = $DB->get_field('modules', 'id', ['name' => 'label'])) {
            $DB->execute("UPDATE {course_modules} SET showdescription = ? WHERE module = ?",
                [1, $modid]);
        }

        // Label savepoint reached.
        upgrade_mod_savepoint(true, 2017062800, 'label');
    }

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
