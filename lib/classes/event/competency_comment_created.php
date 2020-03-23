<?php
//

/**
 * Comment created event for core_competency areas.
 *
 *
 * @package    core_competency
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Comment created event class for core_competency areas.
 *
 *
 * @package    core_competency
 * @since      Moodle 3.1
 * @copyright  2016 Issam Taboubi <issam.taboubi@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_comment_created extends \core\event\comment_created {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' added the comment with id '$this->objectid' to the '$this->component'";
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return null;
    }
}
