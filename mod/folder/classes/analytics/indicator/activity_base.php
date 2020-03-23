<?php
//

/**
 * Activity base class.
 *
 * @package   mod_folder
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_folder\analytics\indicator;

defined('MOODLE_INTERNAL') || die();

/**
 * Activity base class.
 *
 * @package   mod_folder
 * @copyright 2017 onwards Ankit Agarwal <ankit.agrr@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class activity_base extends \core_analytics\local\indicator\community_of_inquiry_activity {

    /**
     * No need to fetch grades for resources.
     *
     * @param \core_analytics\course $course
     * @return void
     */
    public function fetch_student_grades(\core_analytics\course $course) {
    }
}
