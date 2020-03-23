<?php
//

/**
 * Select from drop down list question renderer class.
 *
 * @package    qtype_gapselect
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/gapselect/rendererbase.php');


/**
 * Generates the output for select missing words questions.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_gapselect_renderer extends qtype_elements_embedded_in_question_text_renderer {
    protected function embedded_element(question_attempt $qa, $place,
            question_display_options $options) {
        $question = $qa->get_question();
        $group = $question->places[$place];

        $fieldname = $question->field($place);

        $value = $qa->get_last_qt_var($question->field($place));

        $attributes = array(
            'id'     => $this->box_id($qa, 'p' . $place),
             'class' => 'custom-select place' . $place,
        );
        $groupclass = 'group' . $group;

        if ($options->readonly) {
            $attributes['disabled'] = 'disabled';
        }

        $orderedchoices = $question->get_ordered_choices($group);
        $selectoptions = array();
        foreach ($orderedchoices as $orderedchoicevalue => $orderedchoice) {
            $selectoptions[$orderedchoicevalue] = format_string($orderedchoice->text);
        }

        $feedbackimage = '';
        if ($options->correctness) {
            $response = $qa->get_last_qt_data();
            if (array_key_exists($fieldname, $response)) {
                $fraction = (int) ($response[$fieldname] ==
                        $question->get_right_choice_for($place));
                $attributes['class'] .= ' ' . $this->feedback_class($fraction);
                $feedbackimage = $this->feedback_image($fraction);
            }
        }

        // Use non-breaking space instead of 'Choose...'.
        $selecthtml = html_writer::select($selectoptions, $qa->get_qt_field_name($fieldname),
                        $value, '&nbsp;', $attributes) . ' ' . $feedbackimage;
        return html_writer::tag('span', $selecthtml, array('class' => 'control '.$groupclass));
    }

}
