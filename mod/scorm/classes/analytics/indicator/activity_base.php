<?php
//

/**
 * Activity base class.
 *
 * @package   mod_scorm
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_scorm\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_scorm
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
        // Any view after the data graded counts as feedback viewed.
        return array('\mod_scorm\event\course_module_viewed');
    }

    /**
     * Returns the name of the field that controls activity availability.
     *
     * @return null|string
     */
    protected function get_timeclose_field() {
        return 'timeclose';
    }
}
