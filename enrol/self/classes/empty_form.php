<?php
//

/**
 * Empty enrol_self form.
 *
 * Useful to mimic valid enrol instances UI when the enrolment instance is not available.
 *
 * @package enrol_self
 * @copyright 2015 David Monllaó
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class enrol_self_empty_form extends moodleform {

    /**
     * Form definition.
     * @return void
     */
    public function definition() {
        $this->_form->addElement('header', 'selfheader', $this->_customdata->header);
        $this->_form->addElement('static', 'info', '', $this->_customdata->info);
    }
}
