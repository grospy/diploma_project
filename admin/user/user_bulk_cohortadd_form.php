<?php
//

/**
 * form for bulk user multi cohort add
 *
 * @package    core
 * @subpackage user
 * @copyright  2011 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class user_bulk_cohortadd_form extends moodleform {
    function definition() {
        $mform = $this->_form;
        $cohorts = $this->_customdata;

        $mform->addElement('select', 'cohort', get_string('cohort', 'core_cohort'), $cohorts);
        $mform->addRule('cohort', get_string('required'), 'required', null, 'client');

        $this->add_action_buttons(true, get_string('bulkadd', 'core_cohort'));
    }
}
