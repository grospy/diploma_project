<?php
//

/**
 * mod_assign unit test events.
 *
 * @package    mod_assign
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign_unittests\event;

defined('MOODLE_INTERNAL') || die();

/**
 * mod_assign submission_created unit test event class.
 *
 * @package    mod_assign
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_created extends \mod_assign\event\submission_created {
}

/**
 * mod_assign submission_updated unit test event class.
 *
 * @package    mod_assign
 * @copyright  2013 Adrian Greeve <adrian@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_updated extends \mod_assign\event\submission_updated {
}

/**
 * mod_assign test class for event base.
 *
 * @package    mod_assign
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class nothing_happened extends \mod_assign\event\base {
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    public static function get_name() {
        return 'Nothing happened';
    }
}
