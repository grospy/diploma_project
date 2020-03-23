<?php
//

/**
 * Post-install script for the quiz manual grading report.
 * @package   quiz_grading
 * @copyright 2013 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Post-install script
 */
function xmldb_quiz_grading_install() {
    global $DB;

    $record = new stdClass();
    $record->name         = 'grading';
    $record->displayorder = '6000';
    $record->capability   = 'mod/quiz:grade';

    $DB->insert_record('quiz_reports', $record);
}
