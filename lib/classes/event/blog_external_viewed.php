<?php
//
/**
 * Event for when a new blog entry is associated with a context.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for event to be triggered when an external blog is viewed to moodle.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class blog_external_viewed extends base {

    /**
     * Set basic properties for the event.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventexternalblogsviewed', 'core_blog');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed their registered external blogs";
    }

    /**
     * Used for backup / restore of events.
     * @return array
     */
    public static function get_objectid_mapping() {
        // Blogs are not backed up, so no mapping required for restore.
        return array('db' => 'blog_external', 'restore' => base::NOT_MAPPED);
    }
}


