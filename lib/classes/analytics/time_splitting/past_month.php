<?php
//

/**
 * Time splitting method that generates monthly predictions.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Time splitting method that generates monthly predictions.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class past_month extends \core_analytics\local\time_splitting\past_periodic {

    /**
     * The time splitting method name.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:pastmonth');
    }

    /**
     * Once a month.
     *
     * @return \DateInterval
     */
    public function periodicity() {
        return new \DateInterval('P1M');
    }
}
