<?php
//

/**
 * Any access before the official start of the course.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Any access before the official start of the course.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class any_access_before_start extends \core_analytics\local\indicator\binary {

    /**
     * Returns the name.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('indicator:accessesbeforestart');
    }

    /**
     * required_sample_data
     *
     * @return string[]
     */
    public static function required_sample_data() {
        return array('user', 'course', 'context');
    }

    /**
     * calculate_sample
     *
     * @param int $sampleid
     * @param string $samplesorigin
     * @param int $starttime
     * @param int $endtime
     * @return float
     */
    protected function calculate_sample($sampleid, $samplesorigin, $starttime = false, $endtime = false) {
        global $DB;

        $user = $this->retrieve('user', $sampleid);
        $course = \core_analytics\course::instance($this->retrieve('course', $sampleid));

        if (!$logstore = \core_analytics\manager::get_analytics_logstore()) {
            throw new \coding_exception('No available log stores');
        }

        // Filter by context to use the logstore_standard_log db table index.
        $context = $this->retrieve('context', $sampleid);
        $select = "userid = :userid AND contextlevel = :contextlevel AND contextinstanceid = :contextinstanceid AND " .
            "timecreated < :start";
        $params = array('userid' => $user->id, 'contextlevel' => $context->contextlevel,
            'contextinstanceid' => $context->instanceid, 'start' => $course->get_start());

        $nlogs = $logstore->get_events_select_count($select, $params);
        if ($nlogs) {
            return self::get_max_value();
        } else {
            return self::get_min_value();
        }
    }
}
