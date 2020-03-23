<?php

//

/**
 * Essay grading form
 *
 * @package mod_lesson
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/

/**
 * Include formslib if it has not already been included
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Essay grading form
 *
 * @copyright  2009 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/
class essay_grading_form extends moodleform {

    public function definition() {
        global $CFG;

        $mform = $this->_form;

        $mform->addElement('header', 'formheader', get_string('question', 'lesson'));

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'attemptid');
        $mform->setType('attemptid', PARAM_INT);

        $mform->addElement('hidden', 'mode', 'update');
        $mform->setType('mode', PARAM_ALPHA);

        $mform->addElement('static', 'question', get_string('question', 'lesson'));
        $mform->addElement('static', 'studentanswer', get_string('studentresponse', 'lesson', fullname($this->_customdata['user'], true)));

        $editoroptions = array('noclean' => true, 'maxfiles' => EDITOR_UNLIMITED_FILES, 'maxbytes' => $CFG->maxbytes);
        $mform->addElement('editor', 'response_editor', get_string('comments', 'lesson'), null, $editoroptions);
        $mform->setType('response', PARAM_RAW);

        $mform->addElement('select', 'score', get_string('essayscore', 'lesson'), $this->_customdata['scoreoptions']);
        $mform->setType('score', PARAM_INT);

        $this->add_action_buttons(get_string('cancel'), get_string('savechanges'));

    }
}
