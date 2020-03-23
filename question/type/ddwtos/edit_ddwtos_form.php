<?php
//

/**
 * Defines the editing form for the drag-and-drop words into sentences question type.
 *
 * @package   qtype_ddwtos
 * @copyright 2009 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/gapselect/edit_form_base.php');


/**
 * Drag-and-drop words into sentences editing form definition.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_ddwtos_edit_form extends qtype_gapselect_edit_form_base {
    public function qtype() {
        return 'ddwtos';
    }

    protected function data_preprocessing_choice($question, $answer, $key) {
        $question = parent::data_preprocessing_choice($question, $answer, $key);
        $options = unserialize($answer->feedback);
        $question->choices[$key]['choicegroup'] = $options->draggroup;
        $question->choices[$key]['infinite'] = $options->infinite;
        return $question;
    }

    protected function choice_group($mform) {
        $grouparray = parent::choice_group($mform);
        $grouparray[] = $mform->createElement('checkbox', 'infinite', ' ',
                get_string('infinite', 'qtype_ddwtos'), null,
                array('size' => 1, 'class' => 'tweakcss'));
        return $grouparray;
    }
}
