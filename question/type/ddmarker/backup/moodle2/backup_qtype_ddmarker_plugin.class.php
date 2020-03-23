<?php
//

/**
 * Backup code for qtype_ddmarker.
 *
 * @package   qtype_ddmarker
 * @copyright 2012 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();


/**
 * Provides the information to backup ddmarker questions.
 *
 * @copyright 2011 The Open University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_qtype_ddmarker_plugin extends backup_qtype_plugin {
    /**
     * Get the name of this question type.
     *
     * @return string the question type, like 'ddmarker'.
     */
    protected static function qtype_name() {
        return 'ddmarker';
    }

    /**
     * Returns the qtype information to attach to question element
     */
    protected function define_question_plugin_structure() {
        $qtype = self::qtype_name();
        $plugin = $this->get_plugin_element(null, '../../qtype', $qtype);

        $pluginwrapper = new backup_nested_element($this->get_recommended_name());

        $plugin->add_child($pluginwrapper);

        $dds = new backup_nested_element($qtype, array('id'), array(
            'shuffleanswers', 'correctfeedback', 'correctfeedbackformat',
            'partiallycorrectfeedback', 'partiallycorrectfeedbackformat',
            'incorrectfeedback', 'incorrectfeedbackformat', 'shownumcorrect',
            'showmisplaced')
        );

        $pluginwrapper->add_child($dds);
        $drags = new backup_nested_element('drags');

        $drag = new backup_nested_element('drag', array('id'),
                                                array('no', 'infinite', 'label', 'noofdrags'));
        $drops = new backup_nested_element('drops');

        $drop = new backup_nested_element('drop', array('id'),
                                                array('no', 'shape', 'coords', 'choice'));

        $dds->set_source_table("qtype_{$qtype}",
                                                array('questionid' => backup::VAR_PARENTID));

        $pluginwrapper->add_child($drags);
        $drags->add_child($drag);
        $pluginwrapper->add_child($drops);
        $drops->add_child($drop);

        $drag->set_source_table("qtype_{$qtype}_drags",
                                                    array('questionid' => backup::VAR_PARENTID));

        $drop->set_source_table("qtype_{$qtype}_drops",
                                                    array('questionid' => backup::VAR_PARENTID));

        return $plugin;
    }

    /**
     * Returns one array with filearea => mappingname elements for the qtype
     *
     * Used by {@link get_components_and_fileareas} to know about all the qtype
     * files to be processed both in backup and restore.
     */
    public static function get_qtype_fileareas() {
        $qtype = self::qtype_name();
        return array(
            'correctfeedback' => 'question_created',
            'partiallycorrectfeedback' => 'question_created',
            'incorrectfeedback' => 'question_created',

            'bgimage' => 'question_created');
    }
}
