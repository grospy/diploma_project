<?php
//

/**
 * Interface for an event collection class.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\entities;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for an event collection class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface event_collection_interface extends \IteratorAggregate {
    /**
     * Get the event collection's ID.
     *
     * @return int
     */
    public function get_id();

    /**
     * Get the total number of repeats in the collection.
     *
     * @return int
     */
    public function get_num();
}
