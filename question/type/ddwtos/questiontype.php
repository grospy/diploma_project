<?php
//

/**
 * Question type class for the drag-and-drop words into sentences question type.
 *
 * @package   qtype_ddwtos
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/engine/lib.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');
require_once($CFG->dirroot . '/question/type/gapselect/questiontypebase.php');


/**
 * The drag-and-drop words into sentences question type class.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddwtos extends qtype_gapselect_base {
    protected function choice_group_key() {
        return 'draggroup';
    }

    protected function choice_options_to_feedback($choice) {
        $output = new stdClass();
        $output->draggroup = $choice['choicegroup'];
        $output->infinite = !empty($choice['infinite']);
        return serialize($output);
    }

    protected function feedback_to_choice_options($feedback) {
        $feedbackobj = unserialize($feedback);
        return array('draggroup' => $feedbackobj->draggroup, 'infinite' => $feedbackobj->infinite);
    }

    protected function make_choice($choicedata) {
        $options = unserialize($choicedata->feedback);
        return new qtype_ddwtos_choice(
                $choicedata->answer, $options->draggroup, $options->infinite);
    }

    public function import_from_xml($data, $question, qformat_xml $format, $extra=null) {
        if (!isset($data['@']['type']) || $data['@']['type'] != 'ddwtos') {
            return false;
        }

        $question = $format->import_headers($data);
        $question->qtype = 'ddwtos';

        $question->shuffleanswers = $format->trans_single(
                $format->getpath($data, array('#', 'shuffleanswers', 0, '#'), 1));

        // Import the choices.
        $question->answer = array();
        $question->draggroup = array();
        $question->infinite = array();

        foreach ($data['#']['dragbox'] as $dragboxxml) {
            $question->choices[] = array(
                'answer' => $format->getpath($dragboxxml, array('#', 'text', 0, '#'), '', true),
                'choicegroup' => $format->getpath($dragboxxml, array('#', 'group', 0, '#'), 1),
                'infinite' => array_key_exists('infinite', $dragboxxml['#']),
            );
        }

        $format->import_combined_feedback($question, $data, true);
        $format->import_hints($question, $data, true, false,
                $format->get_format($question->questiontextformat));

        return $question;
    }

    public function export_to_xml($question, qformat_xml $format, $extra = null) {
        $output = '';

        $output .= '    <shuffleanswers>' . $question->options->shuffleanswers .
                "</shuffleanswers>\n";

        $output .= $format->write_combined_feedback($question->options,
                                                    $question->id,
                                                    $question->contextid);

        foreach ($question->options->answers as $answer) {
            $options = unserialize($answer->feedback);

            $output .= "    <dragbox>\n";
            $output .= $format->writetext($answer->answer, 3);
            $output .= "      <group>{$options->draggroup}</group>\n";
            if ($options->infinite) {
                $output .= "      <infinite/>\n";
            }
            $output .= "    </dragbox>\n";
        }

        return $output;
    }
}
