<?php
//

/**
 * Unit tests for the quizaccess_password plugin.
 *
 * @package    quizaccess
 * @subpackage password
 * @category   phpunit
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/accessrule/password/rule.php');


/**
 * Unit tests for the quizaccess_password plugin.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_password_testcase extends basic_testcase {
    public function test_password_access_rule() {
        $quiz = new stdClass();
        $quiz->password = 'frog';
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);
        $rule = new quizaccess_password($quizobj, 0);
        $attempt = new stdClass();

        $this->assertFalse($rule->prevent_access());
        $this->assertEquals($rule->description(),
            get_string('requirepasswordmessage', 'quizaccess_password'));
        $this->assertFalse($rule->prevent_new_attempt(0, $attempt));
        $this->assertFalse($rule->is_finished(0, $attempt));
        $this->assertFalse($rule->end_time($attempt));
        $this->assertFalse($rule->time_left_display($attempt, 0));
    }
}
