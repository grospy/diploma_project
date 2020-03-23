<?php
//

/**
 * Course category viewed event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Course category viewed event class.
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_category_viewed extends base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = 'course_categories';
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcoursecategoryviewed');
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/index.php', array('categoryid' => $this->objectid));
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed the course category with id '$this->objectid'.";
    }

    /**
     * Used for maping events on restore
     *
     * @return bool
     */
    public static function get_objectid_mapping() {
        // Categories are not backed up, so no need to map them on restore.
        return array('db' => 'course_categories', 'restore' => base::NOT_MAPPED);
    }
}
