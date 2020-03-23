<?php
//

/**
 * This file keeps track of upgrades to
 * the lesson module
 *
 * Sometimes, changes between versions involve
 * alterations to database structures and other
 * major things that may break installations.
 *
 * The upgrade function in this file will attempt
 * to perform all the necessary actions to upgrade
 * your older installation to the current version.
 *
 * If there's something it cannot do itself, it
 * will tell you what you need to do.
 *
 * The commands in here will all be database-neutral,
 * using the methods of database_manager class
 *
 * Please do not forget to use upgrade_set_timeout()
 * before any action that may take longer time to finish.
 *
 * @package mod_lesson
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 o
 */

defined('MOODLE_INTERNAL') || die();

/**
 *
 * @global stdClass $CFG
 * @global moodle_database $DB
 * @param int $oldversion
 * @return bool
 */
function xmldb_lesson_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2016120515) {
        // Define new fields to be added to lesson.
        $table = new xmldb_table('lesson');
        $field = new xmldb_field('allowofflineattempts', XMLDB_TYPE_INTEGER, '1', null, null, null, 0, 'completiontimespent');
        // Conditionally launch add field allowofflineattempts.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        // Lesson savepoint reached.
        upgrade_mod_savepoint(true, 2016120515, 'lesson');
    }
    if ($oldversion < 2016120516) {
        // New field for lesson_timer.
        $table = new xmldb_table('lesson_timer');
        $field = new xmldb_field('timemodifiedoffline', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, 0, 'completed');
        // Conditionally launch add field timemodifiedoffline.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        // Lesson savepoint reached.
        upgrade_mod_savepoint(true, 2016120516, 'lesson');
    }

    // Automatically generated Moodle v3.3.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2017051501) {

        // Delete orphaned lesson answer and response files.
        $sql = "SELECT DISTINCT f.contextid, f.component, f.filearea, f.itemid
                  FROM {files} f
             LEFT JOIN {lesson_answers} la ON f.itemid = la.id
                 WHERE component = :component
                   AND (filearea = :fileareaanswer OR filearea = :filearearesponse)
                   AND la.id IS NULL";

        $orphanedfiles = $DB->get_recordset_sql($sql, array('component' => 'mod_lesson', 'fileareaanswer' => 'page_answers',
                'filearearesponse' => 'page_responses'));
        $fs = get_file_storage();
        foreach ($orphanedfiles as $file) {
            $fs->delete_area_files($file->contextid, $file->component, $file->filearea, $file->itemid);
        }
        $orphanedfiles->close();

        upgrade_mod_savepoint(true, 2017051501, 'lesson');
    }

    if ($oldversion < 2019062400) {
        // Delete orphaned group overrides.
        $DB->delete_records_select('lesson_overrides', 'groupid = 0 AND userid IS NULL');

        upgrade_mod_savepoint(true, 2019062400, 'lesson');
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
