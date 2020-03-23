<?php
//

/**
 * Site wide http -> https search-replace form.
 *
 * @package    tool_httpsreplace
 * @copyright Copyright (c) 2016 Blackboard Inc. (http://www.blackboard.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_httpsreplace;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

/**
 * Site wide http -> https search-replace form.
 * @copyright Copyright (c) 2016 Blackboard Inc. (http://www.blackboard.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class form extends \moodleform {

    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'confirmhdr', get_string('confirm'));
        $mform->setExpanded('confirmhdr', true);
        $mform->addElement('checkbox', 'sure', get_string('disclaimer', 'tool_httpsreplace'));
        $mform->addRule('sure', get_string('required'), 'required', null, 'client');
        $mform->disable_form_change_checker();

        $this->add_action_buttons(false, get_string('doit', 'tool_httpsreplace'));
    }
}
