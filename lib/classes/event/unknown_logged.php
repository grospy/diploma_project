<?php
//

/**
 * Unknown event.
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Unknown event class.
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class unknown_logged extends base {
    public function init() {
        throw new \coding_exception('unknown events cannot be triggered');
    }

    public static function get_name() {
        return get_string('eventunknownlogged', 'core');
    }

    public function get_description() {
        return 'Unknown event (' . $this->eventname . ')';
    }
}
