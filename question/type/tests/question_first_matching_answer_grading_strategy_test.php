<?php
//

/**
 * Unit tests for the question_first_matching_answer_grading_strategy class.
 *
 * @package   core_question
 * @copyright 2008 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/question/type/questiontypebase.php');


/**
 * Helper used by the testcases in this file.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_response_answer_comparer implements question_response_answer_comparer {
    protected $answers = array();

    public function __construct($answers) {
        $this->answers = $answers;
    }

    public function get_answers() {
        return $this->answers;
    }

    public function compare_response_with_answer(array $response, question_answer $answer) {
        return $response['answer'] == $answer->answer;
    }
}


/**
 * Tests for {@link question_first_matching_answer_grading_strategy}.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class question_first_matching_answer_grading_strategy_testcase extends advanced_testcase {
    protected function setUp() {
    }

    protected function tearDown() {
    }

    public function test_no_answers_gives_null() {
        $question = new test_response_answer_comparer(array());
        $strategy = new question_first_matching_answer_grading_strategy($question);
        $this->assertNull($strategy->grade(array()));
    }

    public function test_matching_answer_returned1() {
        $answer = new question_answer(0, 'frog', 1, '', FORMAT_HTML);
        $question = new test_response_answer_comparer(array($answer));
        $strategy = new question_first_matching_answer_grading_strategy($question);
        $this->assertSame($answer, $strategy->grade(array('answer' => 'frog')));
    }

    public function test_matching_answer_returned2() {
        $answer = new question_answer(0, 'frog', 1, '', FORMAT_HTML);
        $answer2 = new question_answer(0, 'frog', 0.5, '', FORMAT_HTML);
        $question = new test_response_answer_comparer(array($answer, $answer2));
        $strategy = new question_first_matching_answer_grading_strategy($question);
        $this->assertSame($answer, $strategy->grade(array('answer' => 'frog')));
    }

    public function test_no_matching_answer_gives_null() {
        $answer = new question_answer(0, 'frog', 1, '', FORMAT_HTML);
        $answer2 = new question_answer(0, 'frog', 0.5, '', FORMAT_HTML);
        $question = new test_response_answer_comparer(array($answer, $answer2));
        $strategy = new question_first_matching_answer_grading_strategy($question);
        $this->assertNull($strategy->grade(array('answer' => 'toad')));
    }
}
