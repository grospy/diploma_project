<?php

//

/**
 * Grade import key management form.
 *
 * @package   moodlecore
 * @copyright 2008 Petr Skoda
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/lib/formslib.php');

class key_form extends moodleform {

    // Define the form
    function definition () {
        global $USER, $CFG, $COURSE;

        $mform =& $this->_form;

        $mform->addElement('static', 'value', get_string('keyvalue', 'userkey'));
        $mform->addElement('text', 'iprestriction', get_string('keyiprestriction', 'userkey'), array('size'=>80));
        $mform->addElement('date_time_selector', 'validuntil', get_string('keyvaliduntil', 'userkey'), array('optional'=>true));

        $mform->addHelpButton('iprestriction', 'keyiprestriction', 'userkey');
        $mform->addHelpButton('validuntil', 'keyvaliduntil', 'userkey');
        $mform->setType('iprestriction', PARAM_RAW_TRIMMED);

        $mform->addElement('hidden','id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden','courseid');
        $mform->setType('courseid', PARAM_INT);

        $this->add_action_buttons();
    }
}
