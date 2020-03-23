<?php
//

/**
 * Calendar action event interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\entities;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for an action event class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface action_event_interface extends event_interface {
    /**
     * Get the action event's action.
     *
     * @return action_interface
     */
    public function get_action();
}
