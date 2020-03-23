<?php
//

/**
 * The mod_choice course module viewed event.
 *
 * @package mod_choice
 * @copyright 2013 Adrian Greeve <adrian@moodle.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_choice\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_choice course module viewed event class.
 *
 * @package    mod_choice
 * @since      Moodle 2.6
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'choice';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'choice', 'restore' => 'choice');
    }
}
