<?php
//

/**
 * Description 'question' renderer class.
 *
 * @package    qtype
 * @subpackage description
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();


/**
 * Generates the output for description 'question's.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_description_renderer extends qtype_renderer {
    public function formulation_and_controls(question_attempt $qa,
            question_display_options $options) {

        return html_writer::tag('div', $qa->get_question()->format_questiontext($qa),
                array('class' => 'qtext'));
    }

    public function formulation_heading() {
        return get_string('informationtext', 'qtype_description');
    }
}
