<?php
//

/**
 * Scale deleted event.
 *
 * @package    core
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Scale deleted event class.
 *
 * @package    core
 * @since      Moodle 3.5
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scale_deleted extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'scale';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventscaledeleted', 'core_grades');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        if ($this->courseid) {
            return "The user with id '$this->userid' deleted the custom scale with id '$this->objectid'".
                    " from the course with the id '".$this->courseid."'.";
        }

        return "The user with id '$this->userid' deleted the standard scale with id '$this->objectid'.";
    }

    /**
     * Used for mapping events on restore
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        return array('db' => 'scale', 'restore' => 'scale');
    }

}
