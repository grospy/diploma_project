<?php
//

/**
 * Category filter.
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
 * Category filter.
 *
 * @copyright  2017 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category extends base {
    /**
     * The name of the filter.
     *
     * @return  string
     */
    public static function get_filter_name() {
        return 'category';
    }

    /**
     * Retrieve the list of available filter options.
     *
     * @return  array                   An array whose keys are the valid options
     *                                  And whose values are the values to display
     */
    public static function get_filter_options() {
        $options = \core_course_category::make_categories_list();
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
        $values = $tour->get_filter_values(self::get_filter_name());
        if (empty($values) || empty($values[0])) {
            // There are no values configured, meaning all.
            return true;
        }
        if ($context->contextlevel < CONTEXT_COURSECAT) {
            return false;
        }
        return self::check_contexts($context, $values);
    }

    /**
     * Recursive function allows checking of parent categories.
     *
     * @param context $context
     * @param array $values
     * @return boolean
     */
    private static function check_contexts(context $context, $values) {
        if ($context->contextlevel > CONTEXT_COURSECAT) {
            return self::check_contexts($context->get_parent_context(), $values);
        } else if ($context->contextlevel == CONTEXT_COURSECAT) {
            if (in_array($context->instanceid, $values)) {
                return true;
            } else {
                return self::check_contexts($context->get_parent_context(), $values);
            }
        } else {
            return false;
        }
    }
}
