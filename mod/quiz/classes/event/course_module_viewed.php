<?php
//

/**
 * The mod_quiz course module viewed event.
 *
 * @package    mod_quiz
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_quiz\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_quiz course module viewed event class.
 *
 * @package    mod_quiz
 * @since      Moodle 2.7
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_module_viewed extends \core\event\course_module_viewed {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'quiz';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'quiz', 'restore' => 'quiz');
    }
}
