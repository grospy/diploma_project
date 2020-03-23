<?php
//

/**
 * Library functions for timeline
 *
 * @package   block_timeline
 * @copyright 2018 Peter Dias
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Define constants to store the SORT user preference
 */
define('BLOCK_TIMELINE_SORT_BY_DATES', 'sortbydates');
define('BLOCK_TIMELINE_SORT_BY_COURSES', 'sortbycourses');

/**
 * Define constants to store the FILTER user preference
 */
define('BLOCK_TIMELINE_FILTER_BY_NONE', 'all');
define('BLOCK_TIMELINE_FILTER_BY_OVERDUE', 'overdue');
define('BLOCK_TIMELINE_FILTER_BY_7_DAYS', 'next7days');
define('BLOCK_TIMELINE_FILTER_BY_30_DAYS', 'next30days');
define('BLOCK_TIMELINE_FILTER_BY_3_MONTHS', 'next3months');
define('BLOCK_TIMELINE_FILTER_BY_6_MONTHS', 'next6months');
define('BLOCK_TIMELINE_ACTIVITIES_LIMIT_DEFAULT', 5);

/**
 * Returns the name of the user preferences as well as the details this plugin uses.
 *
 * @return array
 */
function block_timeline_user_preferences() {
    $preferences['block_timeline_user_sort_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_TIMELINE_SORT_BY_DATES,
        'type' => PARAM_ALPHA,
        'choices' => array(BLOCK_TIMELINE_SORT_BY_DATES, BLOCK_TIMELINE_SORT_BY_COURSES)
    );

    $preferences['block_timeline_user_filter_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_TIMELINE_FILTER_BY_30_DAYS,
        'type' => PARAM_ALPHANUM,
        'choices' => array(
                BLOCK_TIMELINE_FILTER_BY_NONE,
                BLOCK_TIMELINE_FILTER_BY_OVERDUE,
                BLOCK_TIMELINE_FILTER_BY_7_DAYS,
                BLOCK_TIMELINE_FILTER_BY_30_DAYS,
                BLOCK_TIMELINE_FILTER_BY_3_MONTHS,
                BLOCK_TIMELINE_FILTER_BY_6_MONTHS
        )
    );

    $preferences['block_timeline_user_limit_preference'] = array(
        'null' => NULL_NOT_ALLOWED,
        'default' => BLOCK_TIMELINE_ACTIVITIES_LIMIT_DEFAULT,
        'type' => PARAM_INT
    );

    return $preferences;
}
