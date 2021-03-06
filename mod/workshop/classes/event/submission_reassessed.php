<?php
//

/**
 * The mod_workshop submission reassessed event.
 *
 * @package    mod_workshop
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_workshop submission reassessed event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int submissionid: Submission ID.
 *      - int workshopid: (optional) Workshop ID.
 *      - float grade: (optional) Assessment grade.
 * }
 *
 * @package    mod_workshop
 * @since      Moodle 2.7
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_reassessed extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'workshop_assessments';
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' reassessed the submission with id '$this->objectid' for the user with " .
            "id '$this->relateduserid' in the workshop with course module id '$this->contextinstanceid'.";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, 'workshop', 'update assessment', 'assessment.php?asid=' . $this->objectid,
            $this->other['submissionid'], $this->contextinstanceid);
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubmissionreassessed', 'mod_workshop');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/workshop/assessment.php?', array('asid' => $this->objectid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }

        if (!isset($this->other['submissionid'])) {
            throw new \coding_exception('The \'submissionid\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'workshop_assessments', 'restore' => 'workshop_assessment');
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['submissionid'] = array('db' => 'workshop_submissions', 'restore' => 'workshop_submission');
        $othermapped['workshopid'] = array('db' => 'workshop', 'restore' => 'workshop');

        return $othermapped;
    }
}
