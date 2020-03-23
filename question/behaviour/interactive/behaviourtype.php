<?php
//

/**
 * Question behaviour type for interactive behaviour.
 *
 * @package    qbehaviour_interactive
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Question behaviour type information for interactive behaviour.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_interactive_type extends question_behaviour_type {
    public function is_archetypal() {
        return true;
    }

    public function allows_multiple_submitted_responses() {
        return true;
    }

    public function can_questions_finish_during_the_attempt() {
        return true;
    }
}
