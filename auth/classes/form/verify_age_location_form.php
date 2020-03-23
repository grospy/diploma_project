<?php
//

/**
 * Age and location verification mform.
 *
 * @package     core_auth
 * @copyright   2018 Mihail Geshoski <mihail@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_auth\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

use moodleform;

/**
 * Age and location verification mform class.
 *
 * @copyright 2018 Mihail Geshoski <mihail@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class verify_age_location_form extends moodleform {
    /**
     * Defines the form fields.
     */
    public function definition() {
        global $CFG;

        $mform = $this->_form;

        $mform->addElement('text', 'age', get_string('whatisyourage'), array('optional'  => false));
        $mform->setType('age', PARAM_RAW);
        $mform->addRule('age', null, 'required', null, 'client');
        $mform->addRule('age', null, 'numeric', null, 'client');

        $countries = get_string_manager()->get_list_of_countries();
        $defaultcountry[''] = get_string('selectacountry');
        $countries = array_merge($defaultcountry, $countries);
        $mform->addElement('select', 'country', get_string('wheredoyoulive'), $countries);
        $mform->addRule('country', null, 'required', null, 'client');
        $mform->setDefault('country', $CFG->country);

        $this->add_action_buttons(true, get_string('proceed'));
    }
}
