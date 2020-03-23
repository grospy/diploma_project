<?php
//

/**
 * Edit course tags form
 *
 * @package    core_course
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Edit course tags form
 *
 * @package    core_course
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class coursetags_form extends moodleform {

    /**
     * Form definition
     */
    public function definition() {
        $mform    = $this->_form;

        $mform->addElement('tags', 'tags', get_string('tags'),
                    array('itemtype' => 'course', 'component' => 'core'));

        $mform->addElement('hidden', 'id', null);
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons();

    }
}
