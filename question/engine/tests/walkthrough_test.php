<?php
//

/**
 * This file contains tests that walks a question through a whole attempt.
 *
 * @package core_question
 * @copyright 2017 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/..//lib.php');
require_once(__DIR__ . '/helpers.php');


/**
 * End-to-end tests of attempting a question.
 *
 * @copyright  2017 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_question_walkthrough_testcase extends qbehaviour_walkthrough_test_base {

    public function test_regrade_does_not_lose_flag() {

        // Create a true-false question with correct answer true.
        $tf = test_question_maker::make_question('truefalse', 'true');
        $this->start_attempt_at_question($tf, 'deferredfeedback', 2);

        // Process a true answer.
        $this->process_submission(array('answer' => 1));

        // Finish the attempt.
        $this->quba->finish_all_questions();

        // Flag the question.
        $this->get_question_attempt()->set_flagged(true);

        // Now change the correct answer to the question, and regrade.
        $tf->rightanswer = false;
        $this->quba->regrade_all_questions();

        // Verify the flag has not been lost.
        $this->assertTrue($this->get_question_attempt()->is_flagged());
    }
}
