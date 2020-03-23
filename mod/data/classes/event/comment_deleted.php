<?php
//

/**
 * The mod_data comment deleted event.
 *
 * @package    mod_data
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_data\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_data comment deleted event class.
 *
 * @package    mod_data
 * @since      Moodle 2.7
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class comment_deleted extends \core\event\comment_deleted {
    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/data/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the comment with id '$this->objectid' from the database activity with " .
            "course module id '$this->contextinstanceid'.";
    }
}
