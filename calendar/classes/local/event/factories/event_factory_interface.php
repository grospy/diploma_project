<?php
//

/**
 * Event factory interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\factories;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for an event factory class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface event_factory_interface {
    /**
     * Creates an instance of an event.
     *
     * @param \stdClass $dbrow The event row from the database.
     * @return \core_calendar\local\event\entities\event_interface
     */
    public function create_instance(\stdClass $dbrow);
}
