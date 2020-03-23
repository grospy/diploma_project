<?php
//

/**
 * Forgot password page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  2006 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once('lib.php');

/**
 * Reset forgotten password form definition.
 *
 * @package    core
 * @subpackage auth
 * @copyright  2006 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class login_forgot_password_form extends moodleform {

    /**
     * Define the forgot password form.
     */
    function definition() {
        global $USER;

        $mform    = $this->_form;
        $mform->setDisableShortforms(true);

        // Hook for plugins to extend form definition.
        core_login_extend_forgot_password_form($mform);

        $mform->addElement('header', 'searchbyusername', get_string('searchbyusername'), '');

        $purpose = user_edit_map_field_purpose($USER->id, 'username');
        $mform->addElement('text', 'username', get_string('username'), 'size="20"' . $purpose);
        $mform->setType('username', PARAM_RAW);

        $submitlabel = get_string('search');
        $mform->addElement('submit', 'submitbuttonusername', $submitlabel);

        $mform->addElement('header', 'searchbyemail', get_string('searchbyemail'), '');

        $purpose = user_edit_map_field_purpose($USER->id, 'email');
        $mform->addElement('text', 'email', get_string('email'), 'maxlength="100" size="30"' . $purpose);
        $mform->setType('email', PARAM_RAW_TRIMMED);

        $submitlabel = get_string('search');
        $mform->addElement('submit', 'submitbuttonemail', $submitlabel);
    }

    /**
     * Validate user input from the forgot password form.
     * @param array $data array of submitted form fields.
     * @param array $files submitted with the form.
     * @return array errors occuring during validation.
     */
    function validation($data, $files) {

        $errors = parent::validation($data, $files);

        // Extend validation for any form extensions from plugins.
        $errors = array_merge($errors, core_login_validate_extend_forgot_password_form($data));

        $errors += core_login_validate_forgot_password_data($data);

        return $errors;
    }

}
