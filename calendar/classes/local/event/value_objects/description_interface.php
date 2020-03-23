<?php
//

/**
 * Description value object interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\value_objects;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for a description value object.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface description_interface {
    /**
     * Get the description's text.
     *
     * @return string The description's text.
     */
    public function get_value();

    /**
     * Get the description's format.
     *
     * @return int The description's format.
     */
    public function get_format();
}
