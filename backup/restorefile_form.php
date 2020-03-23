<?php

//

/**
 * Import backup file form
 * @package   moodlecore
 * @copyright 2010 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir.'/formslib.php');

class course_restore_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $contextid = $this->_customdata['contextid'];
        $mform->addElement('hidden', 'contextid', $contextid);
        $mform->setType('contextid', PARAM_INT);
        $mform->addElement('filepicker', 'backupfile', get_string('files'));
        $mform->addRule('backupfile', get_string('required'), 'required');
        $submit_string = get_string('restore');
        $this->add_action_buttons(false, $submit_string);
    }
}
