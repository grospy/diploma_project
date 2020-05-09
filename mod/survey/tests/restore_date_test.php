<?php
//

/**
 * Restore date tests.
 *
 * @package    mod_survey
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . "/phpunit/classes/restore_date_testcase.php");

/**
 * Restore date tests.
 *
 * @package    mod_survey
 * @copyright  2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_survey_restore_date_testcase extends restore_date_testcase {

    public function test_restore_dates() {
        global $DB;

        list($course, $survey) = $this->create_course_and_module('survey');
        $context = context_module::instance($survey->cmid);

        // Build our questions and responses array.
        $realquestions = array();
        $questions = survey_get_questions($survey);
        $i = 5;
        foreach ($questions as $q) {
            if ($q->type > 0) {
                if ($q->multi) {
                    $subquestions = survey_get_subquestions($q);
                    foreach ($subquestions as $sq) {
                        $key = 'q' . $sq->id;
                        $realquestions[$key] = $i % 5 + 1;
                        $i++;
                    }
                } else {
                    $key = 'q' . $q->id;
                    $realquestions[$key] = $i % 5 + 1;
                    $i++;
                }
            }
        }
        survey_save_answers($survey, $realquestions, $course, $context);
        // We do not want second differences to fail our test because of execution delays.
        $DB->set_field('survey_answers', 'time', $this->startdate);

        // Do backup and restore.
        $newcourseid = $this->backup_and_restore($course);
        $newsurvey = $DB->get_record('survey', ['course' => $newcourseid]);
        $this->assertFieldsNotRolledForward($survey, $newsurvey, ['timecreated', 'timemodified']);

        $answers = $DB->get_records('survey_answers', ['survey' => $newsurvey->id]);
        foreach ($answers as $answer) {
            $this->assertEquals($this->startdate, $answer->time);
        }
    }
}