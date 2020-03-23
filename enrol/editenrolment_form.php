<?php
//

/**
 * Contains the form used to edit enrolments for a user.
 *
 * @package    core_enrol
 * @copyright  2011 Sam Hemelryk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_enrol\enrol_helper;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class enrol_user_enrolment_form extends moodleform {
    function definition() {
        $mform = $this->_form;

        $ue = $this->_customdata['ue'];
        $instancename = $this->_customdata['enrolinstancename'];
        $modal = !empty($this->_customdata['modal']);

        $periodmenu = enrol_get_period_list();
        $duration = enrol_calculate_duration($ue->timestart, $ue->timeend);

        $mform->addElement('static', 'enrolmentmethod', get_string('enrolmentmethod', 'enrol'), $instancename);

        $options = array(ENROL_USER_ACTIVE    => get_string('participationactive', 'enrol'),
                         ENROL_USER_SUSPENDED => get_string('participationsuspended', 'enrol'));
        if (isset($options[$ue->status])) {
            $mform->addElement('select', 'status', get_string('participationstatus', 'enrol'), $options);
        }

        $mform->addElement('date_time_selector', 'timestart', get_string('enroltimestart', 'enrol'), array('optional' => true));

        $mform->addElement('select', 'duration', get_string('enrolperiod', 'enrol'), $periodmenu);
        $mform->setDefault('duration', $duration);
        $mform->disabledIf('duration', 'timestart[enabled]', 'notchecked', 1);
        $mform->disabledIf('duration', 'timeend[enabled]', 'checked', 1);

        $mform->addElement('date_time_selector', 'timeend', get_string('enroltimeend', 'enrol'), array('optional' => true));

        $mform->addElement('static', 'timecreated', get_string('enroltimecreated', 'enrol'), userdate($ue->timecreated));

        $mform->addElement('hidden', 'ue');
        $mform->setType('ue', PARAM_INT);

        $mform->addElement('hidden', 'ifilter');
        $mform->setType('ifilter', PARAM_ALPHA);

        // Show action buttons if this is not being rendered as a fragment.
        if (!$modal) {
            $this->add_action_buttons();
        }

        $this->set_data(array(
            'ue' => $ue->id,
            'status' => $ue->status,
            'timestart' => $ue->timestart,
            'timeend' => $ue->timeend
        ));
    }

    function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (!empty($data['timestart']) and !empty($data['timeend'])) {
            if ($data['timestart'] >= $data['timeend']) {
                $errors['timeend'] = get_string('enroltimeendinvalid', 'enrol');
            }
        }

        return $errors;
    }
}
