<?php
//

/**
 * The mod_chat course module viewed event.
 *
 * @package    mod_chat
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_chat\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_chat course module viewed event class.
 *
 * @package    mod_chat
 * @since      Moodle 2.7
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'chat';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'chat', 'restore' => 'chat');
    }
}
