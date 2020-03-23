<?php
//

/**
 * Unit tests for the quizaccess_offlineattempts plugin.
 *
 * @package    quizaccess_offlineattempts
 * @copyright  2016 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/accessrule/offlineattempts/rule.php');


/**
 * Unit tests for the quizaccess_offlineattempts plugin.
 *
 * @copyright  2016 Juan Leyva
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_offlineattempts_testcase extends basic_testcase {
    public function test_offlineattempts_access_rule() {
        $quiz = new stdClass();
        $quiz->allowofflineattempts = 1;
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);
        $rule = new quizaccess_offlineattempts($quizobj, 0);
        $attempt = new stdClass();

        $this->assertFalse($rule->prevent_access());
        $this->assertFalse($rule->prevent_new_attempt(0, $attempt));
        $this->assertFalse($rule->is_finished(0, $attempt));
        $this->assertFalse($rule->end_time($attempt));
        $this->assertFalse($rule->time_left_display($attempt, 0));
    }
}
