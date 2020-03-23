<?php
//

/**
 * Course filter.
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
 * Course filter.
 *
 * @copyright  2017 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course extends base {
    /**
     * The name of the filter.
     *
     * @return  string
     */
    public static function get_filter_name() {
        return 'course';
    }

    /**
     * Overrides the base add form element with a course selector.
     *
     * @param \MoodleQuickForm $mform
     */
    public static function add_filter_to_form(\MoodleQuickForm &$mform) {
        $options = ['multiple' => true];

        $filtername = self::get_filter_name();
        $key = "filter_{$filtername}";

        $mform->addElement('course', $key, get_string($key, 'tool_usertours'), $options);
        $mform->setDefault($key, '0');
        $mform->addHelpButton($key, $key, 'tool_usertours');
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
        $values = $tour->get_filter_values(self::get_filter_name());
        if (empty($values) || empty($values[0])) {
            // There are no values configured, meaning all.
            return true;
        }
        if (empty($COURSE->id)) {
            return false;
        }
        return in_array($COURSE->id, $values);
    }

    /**
     * Overrides the base prepare the filter values for the form with an integer value.
     *
     * @param   tour            $tour       The tour to prepare values from
     * @param   stdClass        $data       The data value
     * @return  stdClass
     */
    public static function prepare_filter_values_for_form(tour $tour, \stdClass $data) {
        $filtername = static::get_filter_name();
        $key = "filter_{$filtername}";
        $values = $tour->get_filter_values($filtername);
        if (empty($values)) {
            $values = 0;
        }
        $data->$key = $values;
        return $data;
    }

    /**
     * Overrides the base save the filter values from the form to the tour.
     *
     * @param   tour            $tour       The tour to save values to
     * @param   stdClass        $data       The data submitted in the form
     */
    public static function save_filter_values_from_form(tour $tour, \stdClass $data) {
        $filtername = static::get_filter_name();
        $key = "filter_{$filtername}";
        $newvalue = $data->$key;
        if (empty($data->$key)) {
            $newvalue = [];
        }
        $tour->set_filter_values($filtername, $newvalue);
    }
}
