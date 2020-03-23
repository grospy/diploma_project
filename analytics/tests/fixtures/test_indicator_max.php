<?php
//

/**
 * Test indicator.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test indicator.
 *
 * @package   core_analytics
 * @copyright 2017 David Monllaó {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_indicator_max extends \core_analytics\local\indicator\binary {

    /**
     * Returns a lang_string object representing the name for the indicator.
     *
     * Used as column identificator.
     *
     * If there is a corresponding '_help' string this will be shown as well.
     *
     * @return \lang_string
     */
    public static function get_name() : \lang_string {
        // Using a string that exists and contains a corresponding '_help' string.
        return new \lang_string('allowstealthmodules');
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
    protected function calculate_sample($sampleid, $samplesorigin, $starttime, $endtime) {
        return self::MAX_VALUE;
    }
}
