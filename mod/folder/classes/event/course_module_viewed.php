<?php
//

/**
 * The mod_folder course module viewed event.
 *
 * @package    mod_folder
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_folder\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_folder course module viewed event class.
 *
 * @package    mod_folder
 * @since      Moodle 2.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'folder';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'folder', 'restore' => 'folder');
    }
}
