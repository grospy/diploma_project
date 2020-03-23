<?php
//

/**
 * Event observers supported by this module
 *
 * @package    mod_feedback
 * @copyright  2016 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Event observers supported by this module
 *
 * @package    mod_feedback
 * @copyright  2016 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_feedback_observer {

    /**
     * Observer for the even course_content_deleted - delete all course templates.
     *
     * @param \core\event\course_content_deleted $event
     */
    public static function course_content_deleted(\core\event\course_content_deleted $event) {
        global $DB;
        // Delete all templates of given course.
        $DB->delete_records('feedback_template', array('course' => $event->objectid));
    }
}
