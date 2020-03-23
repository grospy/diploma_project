<?php
//

/**
 * Activities due indicator.
 *
 * @package   core
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_course\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/calendar/externallib.php');

/**
 * Activities due indicator.
 *
 * @package   core
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class activities_due extends \core_analytics\local\indicator\binary {

    /**
     * Returns the name.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('indicator:activitiesdue');
    }

    /**
     * required_sample_data
     *
     * @return string[]
     */
    public static function required_sample_data() {
        return array('user');
    }

    /**
     * calculate_sample
     *
     * @param int $sampleid
     * @param string $sampleorigin
     * @param int $starttime
     * @param int $endtime
     * @return float
     */
    protected function calculate_sample($sampleid, $sampleorigin, $starttime = false, $endtime = false) {

        $user = $this->retrieve('user', $sampleid);

        $actionevents = \core_calendar_external::get_calendar_action_events_by_timesort($starttime, $endtime, 0, 1,
            true, $user->id);

        $useractionevents = [];
        if ($actionevents->events) {

            // We first need to check that at least one of the core_calendar_provide_event_action
            // callbacks has the $userid param.
            foreach ($actionevents->events as $event) {
                $nparams = $this->get_provide_event_action_num_params($event->modulename);
                if ($nparams > 2) {
                    // Just the basic info for the insight as we want a low memory usage.
                    $useractionevents[$event->id] = (object)[
                        'name' => $event->name,
                        'url' => $event->url,
                        'time' => $event->timesort,
                        'coursename' => $event->course->fullnamedisplay,
                        'icon' => $event->icon,
                    ];
                }
            }

            if (!empty($useractionevents)) {
                $this->add_shared_calculation_info($sampleid, $useractionevents);
                return self::get_max_value();
            }
        }

        return self::get_min_value();
    }

    /**
     * Returns the number of params declared in core_calendar_provide_event_action's implementation.
     *
     * @param  string $modulename The module name
     * @return int
     */
    private function get_provide_event_action_num_params(string $modulename) {
        $functionname = 'mod_' . $modulename . '_core_calendar_provide_event_action';
        $reflection = new \ReflectionFunction($functionname);
        return $reflection->getNumberOfParameters();
    }
}
