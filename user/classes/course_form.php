<?php
//

/**
 * Form to edit a users course preferences.
 *
 * These are stored as columns in the user table, which
 * is why they are in /user and not /course or /admin.
 *
 * @copyright 2016 Joey Andres <jandres@ualberta.ca>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

namespace core_user;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');  // It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * Class user_course_form.
 *
 * @copyright 2016 Joey Andres <jandres@ualberta.ca>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_form extends \moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $COURSE;

        $mform = $this->_form;

        $mform->addElement('advcheckbox',
            'enableactivitychooser',
            get_string('enableactivitychooser', 'admin'),
            get_string('configenableactivitychooser', 'admin'));
        $mform->setDefault('enableactivitychooser',
            get_user_preferences('usemodchooser', true, $this->_customdata['userid']));

        // Add some extra hidden fields.
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'course', $COURSE->id);
        $mform->setType('course', PARAM_INT);

        $this->add_action_buttons(true, get_string('savechanges'));
    }
}