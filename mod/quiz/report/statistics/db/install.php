<?php
//

/**
 * Post-install script for the quiz statistics report.
 * @package   quiz_statistics
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Post-install script
 */
function xmldb_quiz_statistics_install() {
    global $DB;

    $dbman = $DB->get_manager();

    $record = new stdClass();
    $record->name         = 'statistics';
    $record->displayorder = 8000;
    $record->capability   = 'quiz/statistics:view';

    if ($dbman->table_exists('quiz_reports')) {
        $DB->insert_record('quiz_reports', $record);
    } else {
        $DB->insert_record('quiz_report', $record);
    }
}
