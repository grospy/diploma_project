<?php
//

/**
 * This file contains the form add/update a learning plan.
 *
 * @package   tool_lp
 * @copyright 2015 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_lp\form;
defined('MOODLE_INTERNAL') || die();

use core\form\persistent;
use core_competency\plan as planpersistent;
use required_capability_exception;

/**
 * Learning plan form.
 *
 * @package   tool_lp
 * @copyright 2015 David Monllao
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plan extends persistent {

    protected static $persistentclass = 'core_competency\\plan';

    /**
     * Define the form - called by parent constructor
     */
    public function definition() {
        $mform = $this->_form;
        $context = $this->_customdata['context'];

        $mform->addElement('hidden', 'userid');
        $mform->setType('userid', PARAM_INT);
        $mform->setConstant('userid', $this->_customdata['userid']);

        $mform->addElement('header', 'generalhdr', get_string('general'));

        // Name.
        $mform->addElement('text', 'name', get_string('planname', 'tool_lp'), 'maxlength="100"');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 100), 'maxlength', 100, 'client');
        // Description.
        $mform->addElement('editor', 'description', get_string('plandescription', 'tool_lp'), array('rows' => 4));
        $mform->setType('description', PARAM_CLEANHTML);

        $mform->addElement('date_time_selector', 'duedate', get_string('duedate', 'tool_lp'), array('optional' => true));
        $mform->addHelpButton('duedate', 'duedate', 'tool_lp');

        // Display status selector in form.
        // When the plan was already saved then the status can not be changed via this form.
        $status = planpersistent::get_status_list($this->_customdata['userid']);
        $plan = $this->get_persistent();
        if ($plan->get('id')) {
            // The current status is not selectable (workflow status probably), we just display it.
            $mform->addElement('static', 'staticstatus', get_string('status', 'tool_lp'), $plan->get_statusname());
        } else if (!empty($status) && count($status) > 1) {
            // There is more than one status to select from.
            $mform->addElement('select', 'status', get_string('status', 'tool_lp'), $status);
        } else if (count($status) === 1) {
            // There is only one status to select from.
            $mform->addElement('static', 'staticstatus', get_string('status', 'tool_lp'), current($status));
        } else {
            throw new required_capability_exception($context, 'moodle/competency:planmanage', 'nopermissions', '');
        }

        // Disable short forms.
        $mform->setDisableShortforms();
        $this->add_action_buttons(true, get_string('savechanges', 'tool_lp'));
    }

}
