<?php
//

/**
 * The blog comment deleted event.
 *
 * @package    core
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The blog comment deleted event class.
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class blog_comment_deleted extends comment_deleted {

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/blog/index.php', array('entryid' => $this->other['itemid']));
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the comment for the blog with id '{$this->other['itemid']}'.";
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['itemid'] = array('db' => 'post', 'restore' => base::NOT_MAPPED);
        return $othermapped;
    }
}
