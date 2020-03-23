<?php
//

/**
 * Contains class mod_feedback_course_map_form
 *
 * @package   mod_feedback
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Form for mapping courses to the feedback
 *
 * @package   mod_feedback
 * @copyright 2016 Marina Glancy
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_feedback_course_map_form extends moodleform {
    /**
     * Definition of the form
     */
    public function definition() {
        $mform  = $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $options = array('multiple' => true, 'includefrontpage' => true);
        $mform->addElement('course', 'mappedcourses', get_string('courses'), $options);

        $this->add_action_buttons();
    }
}
