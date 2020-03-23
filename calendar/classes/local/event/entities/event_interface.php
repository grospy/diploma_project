<?php
//

/**
 * Calendar event interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\entities;

use core_calendar\local\event\proxies\proxy_interface;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for an event class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface event_interface {
    /**
     * Get the event's ID.
     *
     * @return integer
     */
    public function get_id();

    /**
     * Get the event's name.
     *
     * @return string
     */
    public function get_name();

    /**
     * Get the event's description.
     *
     * @return description_interface
     */
    public function get_description();

    /**
     * Get the event's location.
     *
     * @return location_interface
     */
    public function get_location();

    /**
     * Get the category object associated with the event.
     *
     * @return proxy_interface
     */
    public function get_category();

    /**
     * Get the course object associated with the event.
     *
     * @return proxy_interface
     */
    public function get_course();

    /**
     * Get the course module object that created the event.
     *
     * @return proxy_interface
     */
    public function get_course_module();

    /**
     * Get the group object associated with the event.
     *
     * @return proxy_interface
     */
    public function get_group();

    /**
     * Get the user object associated with the event.
     *
     * @return proxy_interface
     */
    public function get_user();

    /**
     * Get the event's type.
     *
     * @return string
     */
    public function get_type();

    /**
     * Get the times associated with the event.
     *
     * @return times_interface
     */
    public function get_times();

    /**
     * Get repeats of this event or null if the event has no
     * repeats.
     *
     * @return event_collection_interface|null
     */
    public function get_repeats();

    /**
     * Get the event's subscription.
     *
     * @return proxy_interface
     */
    public function get_subscription();

    /**
     * Get the event's visibility.
     *
     * @return bool true if the event is visible, false otherwise
     */
    public function is_visible();
}
