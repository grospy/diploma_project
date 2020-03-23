<?php
//

/**
 * Activity base class.
 *
 * @package   mod_assign
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_assign
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * feedback_viewed_events
     *
     * @return string[]
     */
    protected function feedback_viewed_events() {
        return array('\mod_assign\event\feedback_viewed');
    }

    /**
     * feedback_check_grades
     *
     * @return bool
     */
    protected function feedback_check_grades() {
        // We need the grade to be released to the student to consider that feedback has been provided.
        return true;
    }

    /**
     * Returns the name of the field that controls activity availability.
     *
     * @return null|string
     */
    protected function get_timeclose_field() {
        return 'duedate';
    }

}
