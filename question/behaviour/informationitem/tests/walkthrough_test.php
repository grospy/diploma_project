<?php
//

/**
 * This file contains tests that walks a question through the information item
 * behaviour.
 *
 * @package   qbehaviour_informationitem
 * @category  test
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once(__DIR__ . '/../../../engine/lib.php');
require_once(__DIR__ . '/../../../engine/tests/helpers.php');


/**
 * Unit tests for the information item behaviour.
 *
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_informationitem_walkthrough_testcase extends qbehaviour_walkthrough_test_base {
    public function test_informationitem_feedback_description() {

        // Create a true-false question with correct answer true.
        $description = test_question_maker::make_question('description');
        $this->start_attempt_at_question($description, 'deferredfeedback');

        // Check the initial state.
        $this->check_current_state(question_state::$todo);
        $this->check_current_mark(null);
        $this->check_current_output($this->get_contains_question_text_expectation($description),
                $this->get_contains_hidden_expectation(
                        $this->quba->get_field_prefix($this->slot) . '-seen', 1),
                $this->get_does_not_contain_feedback_expectation());

        // Check no hidden input when read-only.
        $this->displayoptions->readonly = true;
        $this->check_current_output($this->get_contains_question_text_expectation($description),
                $this->get_does_not_contain_hidden_expectation(
                        $this->quba->get_field_prefix($this->slot) . '-seen', 1));
        $this->displayoptions->readonly = false;

        // Process a submission indicating this question has been seen.
        $this->process_submission(array('-seen' => 1));

        $this->check_current_state(question_state::$complete);
        $this->check_current_mark(null);
        $this->check_current_output($this->get_does_not_contain_correctness_expectation(),
                new question_no_pattern_expectation(
                '/type=\"hidden\"[^>]*name=\"[^"]*seen\"|name=\"[^"]*seen\"[^>]*type=\"hidden\"/'),
                $this->get_does_not_contain_feedback_expectation());

        // Finish the attempt.
        $this->quba->finish_all_questions();

        // Verify.
        $this->check_current_state(question_state::$finished);
        $this->check_current_mark(null);
        $this->check_current_output(
                $this->get_contains_question_text_expectation($description),
                $this->get_contains_general_feedback_expectation($description));

        // Process a manual comment.
        $this->manual_grade('Not good enough!', null, FORMAT_HTML);

        $this->check_current_state(question_state::$manfinished);
        $this->check_current_mark(null);
        $this->check_current_output(
                new question_pattern_expectation('/' . preg_quote('Not good enough!', '/') . '/'));

        // Check that trying to process a manual comment with a grade causes an exception.
        $this->expectException('moodle_exception');
        $this->manual_grade('Not good enough!', 1, FORMAT_HTML);
    }
}
