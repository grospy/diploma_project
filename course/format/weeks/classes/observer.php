<?php
//

/**
 * Event observers used by the weeks course format.
 *
 * @package format_weeks
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Event observer for format_weeks.
 *
 * @package format_weeks
 * @copyright 2017 Mark Nelson <markn@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class format_weeks_observer {

    /**
     * Triggered via \core\event\course_updated event.
     *
     * @param \core\event\course_updated $event
     */
    public static function course_updated(\core\event\course_updated $event) {
        if (class_exists('format_weeks', false)) {
            // If class format_weeks was never loaded, this is definitely not a course in 'weeks' format.
            // Course may still be in another format but format_weeks::update_end_date() will check it.
            format_weeks::update_end_date($event->courseid);
        }
    }

    /**
     * Triggered via \core\event\course_section_created event.
     *
     * @param \core\event\course_section_created $event
     */
    public static function course_section_created(\core\event\course_section_created $event) {
        if (class_exists('format_weeks', false)) {
            // If class format_weeks was never loaded, this is definitely not a course in 'weeks' format.
            // Course may still be in another format but format_weeks::update_end_date() will check it.
            format_weeks::update_end_date($event->courseid);
        }
    }

    /**
     * Triggered via \core\event\course_section_deleted event.
     *
     * @param \core\event\course_section_deleted $event
     */
    public static function course_section_deleted(\core\event\course_section_deleted $event) {
        if (class_exists('format_weeks', false)) {
            // If class format_weeks was never loaded, this is definitely not a course in 'weeks' format.
            // Course may still be in another format but format_weeks::update_end_date() will check it.
            format_weeks::update_end_date($event->courseid);
        }
    }
}
