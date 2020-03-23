<?php
//

/**
 * Transfer form
 *
 * @package    tool_dbtransfer
 * @copyright  2008 Petr Skoda {@link http://skodak.org/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');


/**
 * Definition of db export settings form.
 *
 * @package    tool_dbtransfer
 * @copyright  2008 Petr Skoda {@link http://skodak.org/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class database_export_form extends moodleform {
    /**
     * Define the export form.
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'database', get_string('dbexport', 'tool_dbtransfer'));
        $mform->addElement('textarea', 'description', get_string('description'), array('rows'=>5, 'cols'=>60));
        $mform->setType('description', PARAM_TEXT);

        $this->add_action_buttons(false, get_string('exportdata', 'tool_dbtransfer'));
    }
}
