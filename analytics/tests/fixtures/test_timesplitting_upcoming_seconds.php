<?php
//

/**
 * Test time splitting.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test time splitting.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_timesplitting_upcoming_seconds extends \core_analytics\local\time_splitting\upcoming_periodic {

    /**
     * Every second.
     * @return \DateInterval
     */
    public function periodicity() {
        return new \DateInterval('PT1S');
    }

    /**
     * Just to comply with the interface.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        return new \lang_string('error');
    }
}
