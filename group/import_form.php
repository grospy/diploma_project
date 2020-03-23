<?php
//

/**
 * A form for group import.
 *
 * @package    core_group
 * @copyright  2010 Toyomoyo (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/formslib.php');

/**
 * Groups import form class
 *
 * @package    core_group
 * @copyright  2010 Toyomoyo (http://moodle.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class groups_import_form extends moodleform {

    /**
     * Form definition
     */
    function definition() {
        $mform =& $this->_form;
        $data  = $this->_customdata;

        //fill in the data depending on page params
        //later using set_data
        $mform->addElement('header', 'general', get_string('general'));

        $filepickeroptions = array();
        $filepickeroptions['filetypes'] = '*';
        $filepickeroptions['maxbytes'] = get_max_upload_file_size();
        $mform->addElement('filepicker', 'userfile', get_string('import'), null, $filepickeroptions);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons(true, get_string('importgroups', 'core_group'));

        $this->set_data($data);
    }
}

