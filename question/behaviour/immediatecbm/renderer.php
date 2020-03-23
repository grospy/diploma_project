<?php
//

/**
 * Defines the renderer for the immediate feedback with CBM behaviour.
 *
 * @package    qbehaviour
 * @subpackage immediatecbm
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../deferredcbm/renderer.php');


/**
 * Renderer for outputting parts of a question belonging to the immediate
 * feedback with CBM behaviour.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_immediatecbm_renderer extends qbehaviour_deferredcbm_renderer {
    public function controls(question_attempt $qa, question_display_options $options) {
        $output = parent::controls($qa, $options);
        if ($qa->get_state() == question_state::$invalid &&
                !$qa->get_last_step()->has_behaviour_var('certainty')) {
            $output .= html_writer::tag('div',
                    get_string('pleaseselectacertainty', 'qbehaviour_immediatecbm'),
                    array('class' => 'validationerror'));
        }
        $output .= $this->submit_button($qa, $options);
        return $output;
    }
}
