<?php
//

/**
 * Action interface.
 *
 * @package    core_calendar
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\entities;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for a action class.
 *
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface action_interface {
    /**
     * Get the name of the action.
     *
     * @return string
     */
    public function get_name();

    /**
     * Get the URL of the action.
     *
     * @return \moodle_url
     */
    public function get_url();

    /**
     * Get the number of items that need actioning.
     *
     * @return int
     */
    public function get_item_count();

    /**
     * Get the actions actionability.
     *
     * @return bool
     */
    public function is_actionable();
}
