<?php
//

/**
 * The mod_glossary comment created event.
 *
 * @package    mod_glossary
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_glossary\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_glossary comment created event class.
 *
 * @package    mod_glossary
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
        return new \moodle_url('/mod/glossary/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' added the comment with id '$this->objectid' to the glossary activity " .
            "with course module id '$this->contextinstanceid'.";
    }
}
