<?php
//

/**
 * Time splitting method that generates predictions one month after the analysable start.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\analytics\time_splitting;

defined('MOODLE_INTERNAL') || die();

/**
 * Time splitting method that generates predictions one month after the analysable start.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class one_month_after_start extends \core_analytics\local\time_splitting\after_start {

    /**
     * The time splitting method name.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('timesplitting:onemonthafterstart');
    }

    /**
     * The period we should wait until we generate predictions for this.
     *
     * @param  \core_analytics\analysable $analysable Not used in this implementation.
     * @return \DateInterval
     */
    protected function wait_period(\core_analytics\analysable $analysable) {
        return new \DateInterval('P1M');
    }
}
