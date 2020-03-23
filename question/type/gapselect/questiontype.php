<?php
//

/**
 * Question type class for the select missing words question type.
 *
 * @package    qtype_gapselect
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/engine/lib.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');
require_once($CFG->dirroot . '/question/type/gapselect/questiontypebase.php');


/**
 * The select missing words question type class.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_gapselect extends qtype_gapselect_base {
    protected function choice_options_to_feedback($choice) {
        return $choice['choicegroup'];
    }

    protected function make_choice($choicedata) {
        return new qtype_gapselect_choice($choicedata->answer, $choicedata->feedback);
    }

    protected function feedback_to_choice_options($feedback) {
        return array('selectgroup' => $feedback);
    }


    protected function choice_group_key() {
        return 'selectgroup';
    }

    public function import_from_xml($data, $question, qformat_xml $format, $extra=null) {
        if (!isset($data['@']['type']) || $data['@']['type'] != 'gapselect') {
            return false;
        }

        $question = $format->import_headers($data);
        $question->qtype = 'gapselect';

        $question->shuffleanswers = $format->trans_single(
                $format->getpath($data, array('#', 'shuffleanswers', 0, '#'), 1));

        if (!empty($data['#']['selectoption'])) {
            // Modern XML format.
            $selectoptions = $data['#']['selectoption'];
            $question->answer = array();
            $question->selectgroup = array();

            foreach ($data['#']['selectoption'] as $selectoptionxml) {
                $question->choices[] = array(
                    'answer'      => $format->getpath($selectoptionxml,
                                                      array('#', 'text', 0, '#'), '', true),
                    'choicegroup' => $format->getpath($selectoptionxml,
                                                      array('#', 'group', 0, '#'), 1),
                );
            }

        } else {
            // Legacy format containing PHP serialisation.
            foreach ($data['#']['answer'] as $answerxml) {
                $ans = $format->import_answer($answerxml);
                $question->choices[] = array(
                    'answer' => $ans->answer,
                    'choicegroup' => $ans->feedback,
                );
            }
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
            $output .= "    <selectoption>\n";
            $output .= $format->writetext($answer->answer, 3);
            $output .= "      <group>{$answer->feedback}</group>\n";
            $output .= "    </selectoption>\n";
        }

        return $output;
    }
}
