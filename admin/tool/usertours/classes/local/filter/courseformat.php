<?php
//

/**
 * Course format filter.
 *
 * @package    tool_usertours
 * @copyright  2017 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_usertours\local\filter;

defined('MOODLE_INTERNAL') || die();

use tool_usertours\tour;
use context;

/**
 * Course format filter.
 *
 * @copyright  2017 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class courseformat extends base {
    /**
     * The name of the filter.
     *
     * @return  string
     */
    public static function get_filter_name() {
        return 'courseformat';
    }

    /**
     * Retrieve the list of available filter options.
     *
     * @return  array                   An array whose keys are the valid options
     *                                  And whose values are the values to display
     */
    public static function get_filter_options() {
        $options = [];
        $courseformats = get_sorted_course_formats(true);
        foreach ($courseformats as $courseformat) {
            $options[$courseformat] = get_string('pluginname', "format_$courseformat");
        }
        return $options;
    }

    /**
     * Check whether the filter matches the specified tour and/or context.
     *
     * @param   tour        $tour       The tour to check
     * @param   context     $context    The context to check
     * @return  boolean
     */
    public static function filter_matches(tour $tour, context $context) {
        global $COURSE;
        $values = $tour->get_filter_values('courseformat');
        if (empty($values)) {
            // There are no values configured, meaning all.
            return true;
        }
        if (empty($COURSE->format)) {
            return false;
        }
        return in_array($COURSE->format, $values);
    }
}
