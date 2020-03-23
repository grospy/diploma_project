<?php
//

/**
 * The mod_assign submission_created abstract event.
 *
 * @package    mod_assign
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_assign submission_created abstract event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int submissionid: ID number of this submission.
 *      - int submissionattempt: Number of attempts made on this submission.
 *      - string submissionstatus: Status of the submission.
 *      - int groupid: (optional) The group ID if this is a teamsubmission.
 *      - string groupname: (optional) The name of the group if this is a teamsubmission.
 * }
 *
 * @package    mod_assign
 * @since      Moodle 2.7
 * @copyright  2014 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class submission_created extends base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubmissioncreated', 'mod_assign');
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['submissionid'])) {
            throw new \coding_exception('The \'submissionid\' value must be set in other.');
        }
        if (!isset($this->other['submissionattempt'])) {
            throw new \coding_exception('The \'submissionattempt\' value must be set in other.');
        }
        if (!isset($this->other['submissionstatus'])) {
            throw new \coding_exception('The \'submissionstatus\' value must be set in other.');
        }
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['submissionid'] = array('db' => 'assign_submission', 'restore' => 'submission');
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');

        return $othermapped;
    }
}
