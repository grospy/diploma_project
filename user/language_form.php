<?php
//

/**
 * Form to edit a users preferred language
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package core_user
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    //  It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/user/lib.php');

/**
 * Class user_edit_form.
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_edit_language_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $CFG, $COURSE, $USER;

        $mform = $this->_form;
        $userid = $USER->id;

        if (is_array($this->_customdata)) {
            if (array_key_exists('userid', $this->_customdata)) {
                $userid = $this->_customdata['userid'];
            }
        }

        // Add some extra hidden fields.
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'course', $COURSE->id);
        $mform->setType('course', PARAM_INT);

        $purpose = user_edit_map_field_purpose($userid, 'lang');
        $translations = get_string_manager()->get_list_of_translations();
        $mform->addElement('select', 'lang', get_string('preferredlanguage'), $translations, $purpose);
        $mform->setDefault('lang', core_user::get_property_default('lang'));

        $this->add_action_buttons(true, get_string('savechanges'));
    }

    /**
     * Extend the form definition after the data has been parsed.
     */
    public function definition_after_data() {
        global $CFG, $DB, $OUTPUT;

        $mform = $this->_form;

        // If language does not exist, use site default lang.
        if ($langsel = $mform->getElementValue('lang')) {
            $lang = reset($langsel);
            // Check lang exists.
            if (!get_string_manager()->translation_exists($lang, false)) {
                $langel =& $mform->getElement('lang');
                $langel->setValue(core_user::get_property_default('lang'));
            }
        }

    }

}


