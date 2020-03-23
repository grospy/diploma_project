<?php
//

/**
 * Question behaviour type for immediate feedback behaviour.
 *
 * @package    qbehaviour_immediatefeedback
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Question behaviour type information for immediate feedback behaviour.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_immediatefeedback_type extends question_behaviour_type {
    public function is_archetypal() {
        return true;
    }

    public function can_questions_finish_during_the_attempt() {
        return true;
    }
}
