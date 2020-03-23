<?php
//

/**
 * Test indicator.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Test indicator.
 *
 * @package   core_analytics
 * @copyright 2019 David Monllao {@link http://www.davidmonllao.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_indicator_discrete extends \core_analytics\local\indicator\discrete {

    /**
     * Returns the name.
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
     * The different classes this discrete indicator provides.
     * @return [type] [description]
     */
    protected static function get_classes() {
        return [0, 1, 2, 3, 4];
    }

    /**
     * Just for testing.
     *
     * @param  float $value
     * @param  string $subtype
     * @return string
     */
    public function get_calculation_outcome($value, $subtype = false) {
        return self::OUTCOME_OK;
    }

    /**
     * Custom indicator calculated value display as otherwise we would display meaningless numbers to users.
     *
     * @param  float  $value
     * @param  string $subtype
     * @return string
     */
    public function get_display_value($value, $subtype = false) {
        return $value;
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
        return 4;
    }
}
