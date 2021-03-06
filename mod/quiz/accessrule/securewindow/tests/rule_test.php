<?php
//

/**
 * Unit tests for the quizaccess_securewindow plugin.
 *
 * @package    quizaccess
 * @subpackage securewindow
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/accessrule/securewindow/rule.php');


/**
 * Unit tests for the quizaccess_securewindow plugin.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_securewindow_testcase extends basic_testcase {
    public static $includecoverage = array('mod/quiz/accessrule/securewindow/rule.php');

    // Nothing very testable in this class, just test that it obeys the general access rule contact.
    public function test_securewindow_access_rule() {
        $quiz = new stdClass();
        $quiz->browsersecurity = 'securewindow';
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);
        $rule = new quizaccess_securewindow($quizobj, 0);
        $attempt = new stdClass();

        $this->assertFalse($rule->prevent_access());
        $this->assertEmpty($rule->description());
        $this->assertFalse($rule->prevent_new_attempt(0, $attempt));
        $this->assertFalse($rule->is_finished(0, $attempt));
        $this->assertFalse($rule->end_time($attempt));
        $this->assertFalse($rule->time_left_display($attempt, 0));
    }
}
