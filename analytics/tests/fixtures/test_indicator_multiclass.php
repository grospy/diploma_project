<?php
//

/**
 * Multiclass test indicator.
 *
 * @package   core_analytics
 * @copyright 2019 Vlad Apetrei
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Multiclass test indicator.
 *
 * @package   core_analytics
 * @copyright 2019 Vlad Apetrei
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class test_indicator_multiclass extends \core_analytics\local\indicator\linear {

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
     * include_averages
     *
     * @return bool
     */
    protected static function include_averages() {
        return false;
    }

    /**
     * required_sample_data
     *
     * @return string[]
     */
    public static function required_sample_data() {
        return array('course');
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

        $course = $this->retrieve('course', $sampleid);

        $firstchar = substr($course->fullname, 0, 1);
        if ($firstchar === 'a') {
            return 1;
        } else if ($firstchar === 'b') {
            return -1;
        } else if ($firstchar === 'c') {
            return 1;
        } else {
            return self::MAX_VALUE;
        }
    }
}
