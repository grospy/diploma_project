<?php
//

/**
 * The mod_lti course module viewed event.
 *
 * @package    mod_lti
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lti\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_lti course module viewed event class.
 *
 * @package    mod_lti
 * @since      Moodle 2.7
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'lti';
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_objectid_mapping() {
        return array('db' => 'lti', 'restore' => 'lti');
    }
}
