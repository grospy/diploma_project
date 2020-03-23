<?php
//

/**
 * Times interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\value_objects;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for various times.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface times_interface {
    /**
     * Get the start time.
     *
     * @return \DateTimeImmutable
     */
    public function get_start_time();

    /**
     * Get the end time.
     *
     * @return \DateTimeImmutable
     */
    public function get_end_time();

    /**
     * Get the duration (the time between start and end).
     *
     * @return \DateInterval
     */
    public function get_duration();

    /**
     * Get the sort time.
     *
     * @return \DateTimeImmutable
     */
    public function get_sort_time();

    /**
     * Get the modified time.
     *
     * @return \DateTimeImmutable
     */
    public function get_modified_time();
}
