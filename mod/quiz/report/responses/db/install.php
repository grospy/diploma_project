<?php
//

/**
 * Post-install script for the quiz responses report.
 * @package   quiz_responses
 * @copyright 2013 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Post-install script
 */
function xmldb_quiz_responses_install() {
    global $DB;

    $record = new stdClass();
    $record->name         = 'responses';
    $record->displayorder = '9000';

    $DB->insert_record('quiz_reports', $record);
}
