<?php
//

/**
 * Defines the renderer the information item behaviour.
 *
 * @package   qbehaviour_informationitem
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Renderer for outputting parts of a question belonging to the information
 * item behaviour.
 *
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qbehaviour_informationitem_renderer extends qbehaviour_renderer {
    public function controls(question_attempt $qa, question_display_options $options) {
        if ($options->readonly || $qa->get_state() != question_state::$todo) {
            return '';
        }

        // Hidden input to move the question into the complete state.
        return html_writer::empty_tag('input', array(
            'type' => 'hidden',
            'name' => $qa->get_behaviour_field_name('seen'),
            'value' => 1,
        ));
    }
}
