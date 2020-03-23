<?php
//

/**
 * Defines the renderer for the immediate feedback behaviour.
 *
 * @package    qbehaviour
 * @subpackage immediatefeedback
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Renderer for outputting parts of a question belonging to the immediate
 * feedback behaviour.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_immediatefeedback_renderer extends qbehaviour_renderer {
    public function controls(question_attempt $qa, question_display_options $options) {
        return $this->submit_button($qa, $options);
    }
}
