<?php
//

/**
 * Create update form mapper interface.
 *
 * @package    core_calendar
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\mappers;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/calendar/lib.php');

/**
 * Interface for a create_update_form_mapper class
 *
 * @copyright  2017 Ryan Wyllie <ryan@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface create_update_form_mapper_interface {
    /**
     * Generate the appropriate data for the form from a legacy event.
     *
     * @param \calendar_event $legacyevent
     * @return stdClass
     */
    public function from_legacy_event_to_data(\calendar_event $legacyevent);

    /**
     * Generate the appropriate calendar_event properties from the form data.
     *
     * @param \stdClass $data
     * @return stdClass
     */
    public function from_data_to_event_properties(\stdClass $data);
}
