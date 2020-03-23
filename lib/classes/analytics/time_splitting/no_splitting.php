<?php
//

/**
 * No time splitting method.
 *
 * Used when time is not a factor to consider into the equation.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * No time splitting method.
 *
 * Used when time is not a factor to consider into the equation.
 *
 * @package   core
 * @copyright 2016 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class no_splitting extends \core_analytics\local\time_splitting\base {

    /**
     * Returns a lang_string object representing the name for the time splitting method.
     *
     * Used as column identificator.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:nosplitting');
    }

    /**
     * ready_to_predict
     *
     * @param array $range
     * @return true
     */
    public function ready_to_predict($range) {
        return true;
    }

    /**
     * define_ranges
     *
     * @return array
     */
    protected function define_ranges() {
        return [
            [
                'start' => 0,
                'end' => \core_analytics\analysable::MAX_TIME,
                // Time is ignored as we overwrite ready_to_predict.
                'time' => 0
            ]
        ];
    }
}
