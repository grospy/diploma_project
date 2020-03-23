<?php
//

/**
 * The report_participation report viewed event.
 *
 * @package    report_participation
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace report_participation\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The report_participation report viewed event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int instanceid: Id of instance.
 *      - int roleid: Role id for whom report is viewed.
 *      - int groupid: (optional) group id.
 *      - int timefrom: (optional) time from which report is viewed.
 *      - string action: (optional) action viewed.
 * }
 *
 * @package    report_participation
 * @since      Moodle 2.7
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_viewed extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportviewed', 'report_participation');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed the course participation report for the course with id '$this->courseid'.";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, "course", "report participation", "report/participation/index.php?id=" . $this->courseid,
                $this->courseid);
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/report/participation/index.php', array('id' => $this->courseid,
            'instanceid' => $this->other['instanceid'], 'roleid' => $this->other['roleid']));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (empty($this->other['instanceid'])) {
            throw new \coding_exception('The \'instanceid\' value must be set in other.');
        }

        if (empty($this->other['roleid'])) {
            throw new \coding_exception('The \'roleid\' value must be set in other.');
        }

        if (!isset($this->other['groupid'])) {
            throw new \coding_exception('The \'groupid\' value must be set in other.');
        }

        if (!isset($this->other['timefrom'])) {
            throw new \coding_exception('The \'timefrom\' value must be set in other.');
        }

        if (!isset($this->other['action'])) {
            throw new \coding_exception('The \'action\' value must be set in other.');
        }

    }

    public static function get_other_mapping() {
        $othermapped = array();
        // This is a badly named variable - it represents "cm->id" not "cm->instance".
        $othermapped['instanceid'] = array('db' => 'course_modules', 'restore' => 'course_module');

        $othermapped['roleid'] = array('db' => 'role', 'restore' => 'role');
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');

        return $othermapped;

    }
}

