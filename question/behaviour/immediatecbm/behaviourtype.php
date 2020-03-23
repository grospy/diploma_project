<?php
//

/**
 * Question behaviour type for immediate feedback with CBM behaviour.
 *
 * @package    qbehaviour_adaptive
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../deferredcbm/behaviourtype.php');


/**
 * Question behaviour type information for immediate feedback with CBM.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_immediatecbm_type extends qbehaviour_deferredcbm_type {

    public function get_unused_display_options() {
        return array();
    }

    public function can_questions_finish_during_the_attempt() {
        return true;
    }
}
