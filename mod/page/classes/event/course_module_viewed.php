<?php
//

/**
 * The mod_page course module viewed event.
 *
 * @package    mod_page
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_page\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_page course module viewed event class.
 *
 * @package    mod_page
 * @since      Moodle 2.6
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'page';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'page', 'restore' => 'page');
    }
}

