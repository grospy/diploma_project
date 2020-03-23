<?php
//

/**
 * Makes some protected methods of quiz_attempts_report public to facilitate testing.
 *
 * @package   quiz_overview
 * @copyright 2020 Huong Nguyen <huongnv13@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/report/attemptsreport.php');

/**
 * Makes some protected methods of quiz_attempts_report public to facilitate testing.
 *
 * @copyright 2020 Huong Nguyen <huongnv13@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_quiz_attempts_report extends quiz_attempts_report {

    /**
     * Override this function to displays the report.
     * @param object $cm the course-module for this quiz.
     * @param object $course the course we are in.
     * @param object $quiz this quiz.
     */
    public function display($cm, $course, $quiz) {

    }

    /**
     * Testable delete_selected_attempts function.
     *
     * @param object $quiz
     * @param object $cm
     * @param array $attemptids
     * @param \core\dml\sql_join $allowedjoins
     */
    public function delete_selected_attempts($quiz, $cm, $attemptids, \core\dml\sql_join $allowedjoins) {
        parent::delete_selected_attempts($quiz, $cm, $attemptids, $allowedjoins);
    }
}
