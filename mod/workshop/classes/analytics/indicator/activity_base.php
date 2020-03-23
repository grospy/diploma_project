<?php
//

/**
 * Activity base class.
 *
 * @package   mod_workshop
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_workshop
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * feedback_check_grades
     *
     * @return bool
     */
    protected function feedback_check_grades() {
        return true;
    }

    /**
     * feedback_viewed_events
     *
     * @return string[]
     */
    protected function feedback_viewed_events() {
        return array('\mod_workshop\event\course_module_viewed', '\mod_workshop\event\submission_viewed');
    }

    /**
     * Returns the name of the field that controls activity availability.
     *
     * @return null|string
     */
    protected function get_timeclose_field() {
        return 'submissionend';
    }
}
