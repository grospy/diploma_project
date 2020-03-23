<?php
//

/**
 * Time splitting method that generates insights every three days and calculates indicators using upcoming dates.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Time splitting method that generates insights every three days and calculates indicators using upcoming dates.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class upcoming_3_days extends \core_analytics\local\time_splitting\upcoming_periodic {

    /**
     * The time splitting method name.
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:upcoming3days');
    }

    /**
     * Once every three days.
     * @return \DateInterval
     */
    public function periodicity() {
        return new \DateInterval('P3D');
    }
}