<?php
//

/**
 * The report_log report viewed event.
 *
 * @package    report_log
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace report_log\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The report_log report viewed event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - int groupid: Group to display.
 *      - int date: Date to display logs from.
 *      - int modid: Module id for which logs were displayed.
 *      - string modaction: Module action.
 *      - string logformat: Log format in which logs were displayed.
 * }
 *
 * @package    report_log
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
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportviewed', 'report_log');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed the log report for the course with id '$this->courseid'.";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, "course", "report log", "report/log/index.php?id=$this->courseid", $this->courseid);
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/report/log/index.php', array('id' => $this->courseid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['groupid'])) {
            throw new \coding_exception('The \'groupid\' value must be set in other.');
        }

        if (!isset($this->other['date'])) {
            throw new \coding_exception('The \'date\' value must be set in other.');
        }

        if (!isset($this->other['modid'])) {
            throw new \coding_exception('The \'modid\' value must be set in other.');
        }

        if (!isset($this->other['modaction'])) {
            throw new \coding_exception('The \'modaction\' value must be set in other.');
        }

        if (!isset($this->other['logformat'])) {
            throw new \coding_exception('The \'logformat\' value must be set in other.');
        }

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['modid'] = array('db' => 'course_modules', 'restore' => 'course_module');
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');

        return $othermapped;
    }
}
