<?php
//

/**
 * The assignsubmission_comments comment created event.
 *
 * @package    assignsubmission_comments
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace assignsubmission_comments\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The assignsubmission_comments comment created event class.
 *
 * @package    assignsubmission_comments
 * @since      Moodle 2.7
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class comment_created extends \core\event\comment_created {
    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/assign/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' added the comment with id '$this->objectid' to the submission " .
            "with id '{$this->other['itemid']}' for the assignment with course module id '$this->contextinstanceid'.";
    }
}
