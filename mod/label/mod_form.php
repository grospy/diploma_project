<?php

//

/**
 * Add label form
 *
 * @package mod_label
 * @copyright  2006 Jamie Pratt
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_label_mod_form extends moodleform_mod {

    function definition() {
        global $PAGE;

        $PAGE->force_settings_menu();

        $mform = $this->_form;

        $mform->addElement('header', 'generalhdr', get_string('general'));
        $this->standard_intro_elements(get_string('labeltext', 'label'));

        // Label does not add "Show description" checkbox meaning that 'intro' is always shown on the course page.
        $mform->addElement('hidden', 'showdescription', 1);
        $mform->setType('showdescription', PARAM_INT);

        $this->standard_coursemodule_elements();

//-------------------------------------------------------------------------------
// buttons
        $this->add_action_buttons(true, false, null);

    }

}
