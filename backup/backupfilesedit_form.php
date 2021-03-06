<?php
//

/**
 * Manage backup files
 * @package   moodlecore
 * @copyright 2010 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir.'/formslib.php');

class backup_files_edit_form extends moodleform {

    /**
     * Form definition.
     */
    public function definition() {
        $mform =& $this->_form;

        $types = (FILE_INTERNAL | FILE_REFERENCE | FILE_CONTROLLED_LINK);
        $options = array('subdirs' => 0, 'maxfiles' => -1, 'accepted_types' => '*', 'return_types' => $types);

        $mform->addElement('filemanager', 'files_filemanager', get_string('files'), null, $options);

        $mform->addElement('hidden', 'contextid', $this->_customdata['contextid']);
        $mform->setType('contextid', PARAM_INT);

        $mform->addElement('hidden', 'currentcontext', $this->_customdata['currentcontext']);
        $mform->setType('currentcontext', PARAM_INT);

        $mform->addElement('hidden', 'filearea', $this->_customdata['filearea']);
        $mform->setType('filearea', PARAM_AREA);

        $mform->addElement('hidden', 'component', $this->_customdata['component']);
        $mform->setType('component', PARAM_COMPONENT);

        $mform->addElement('hidden', 'returnurl', $this->_customdata['returnurl']);
        $mform->setType('returnurl', PARAM_URL);

        $this->add_action_buttons(true, get_string('savechanges'));
        $this->set_data($this->_customdata['data']);
    }
}
