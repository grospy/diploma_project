<?php
//

/**
 * minimalistic edit form
 *
 * @package   core_user
 * @category  files
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

/**
 * Class user_files_form
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_files_form extends moodleform {

    /**
     * Add elements to this form.
     */
    public function definition() {
        $mform = $this->_form;

        $data = $this->_customdata['data'];
        $options = $this->_customdata['options'];

        $mform->addElement('filemanager', 'files_filemanager', get_string('files'), null, $options);
        $mform->addElement('hidden', 'returnurl', $data->returnurl);
        if (isset($data->emaillink)) {
            $emaillink = html_writer::link(new moodle_url('mailto:' . $data->emaillink), $data->emaillink);
            $mform->addElement('static', 'emailaddress', '',
                get_string('emailtoprivatefiles', 'moodle', $emaillink));
        }
        $mform->setType('returnurl', PARAM_LOCALURL);

        $this->add_action_buttons(true, get_string('savechanges'));

        $this->set_data($data);
    }

    /**
     * Validate incoming data.
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = array();
        $draftitemid = $data['files_filemanager'];
        if (file_is_draft_area_limit_reached($draftitemid, $this->_customdata['options']['areamaxbytes'])) {
            $errors['files_filemanager'] = get_string('userquotalimit', 'error');
        }

        return $errors;
    }
}
