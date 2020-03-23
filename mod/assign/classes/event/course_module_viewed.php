<?php
//

/**
 * The mod_assign course module viewed event.
 *
 * @package    mod_assign
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign\event;

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 * The mod_assign course module viewed event class.
 *
 * @package    mod_assign
 * @since      Moodle 3.6
 * @copyright  2018 Victor Deniz <victor@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'assign';
    }

    /**
     * Get objectid mapping
     */
    public static function get_objectid_mapping() {
        return array('db' => 'assign', 'restore' => 'assign');
    }
}