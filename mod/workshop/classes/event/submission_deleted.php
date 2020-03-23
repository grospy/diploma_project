<?php
//

/**
 * The mod_workshop submission deleted event.
 *
 * @package    mod_workshop
 * @copyright  2015 Paul Nicholls
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_workshop submission deleted event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - string submissiontitle: (optional) Submission title.
 * }
 *
 * @package    mod_workshop
 * @since      Moodle 3.1
 * @copyright  2015 Paul Nicholls
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_deleted extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'workshop_submissions';
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the submission with id '$this->objectid' for the workshop " .
            "with course module id '$this->contextinstanceid'.";
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubmissiondeleted', 'workshop');
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/workshop/submission.php',
                array('cmid' => $this->contextinstanceid, 'id' => $this->objectid));
    }

    /**
     * Replace add_to_log() statement.
     *
     * @return array of parameters to be passed to legacy add_to_log() function.
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, 'workshop', 'delete submission',
            'submission.php?cmid=' . $this->contextinstanceid . '&id=' . $this->objectid,
            $this->objectid, $this->contextinstanceid);
    }

    /**
     * Defines mapping of the 'objectid' property when restoring course logs.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'workshop_submissions', 'restore' => 'workshop_submission');
    }

    /**
     * Defines mapping of the 'other' property when restoring course logs.
     *
     * @return array|bool
     */
    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
