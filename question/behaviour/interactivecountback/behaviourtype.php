<?php
//

/**
 * Question behaviour type for interactive behaviour with count-back scoring behaviour.
 *
 * @package    qbehaviour_interactivecountback
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../interactive/behaviourtype.php');


/**
 * Question behaviour type information for interactive behaviour with count-back scoring.
 *
 * @copyright  2012 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_interactivecountback_type extends qbehaviour_interactive_type {
    public function is_archetypal() {
        return false;
    }
}
