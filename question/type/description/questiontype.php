<?php
//

/**
 * Question type class for the description 'question' type.
 *
 * @package    qtype
 * @subpackage description
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');


/**
 * The description 'question' type.
 *
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_description extends question_type {
    public function is_real_question_type() {
        return false;
    }

    public function is_usable_by_random() {
        return false;
    }

    public function can_analyse_responses() {
        return false;
    }

    public function save_question($question, $form) {
        // Make very sure that descriptions can'e be created with a grade of
        // anything other than 0.
        $form->defaultmark = 0;
        return parent::save_question($question, $form);
    }

    public function actual_number_of_questions($question) {
        // Used for the feature number-of-questions-per-page
        // to determine the actual number of questions wrapped by this question.
        // The question type description is not even a question
        // in itself so it will return ZERO!
        return 0;
    }

    public function get_random_guess_score($questiondata) {
        return null;
    }
}
