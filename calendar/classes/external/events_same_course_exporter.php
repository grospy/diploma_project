<?php
//

/**
 * Contains event class for displaying a list of calendar events for a single course.
 *
 * @package   core_calendar
 * @copyright 2017 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\external;

defined('MOODLE_INTERNAL') || die();

use \renderer_base;

/**
 * Class for displaying a list of calendar events for a single course.
 *
 * This class uses the events relateds cache in order to get the related
 * data for exporting an event without having to naively hit the database
 * for each event.
 *
 * @package   core_calendar
 * @copyright 2017 Ryan Wyllie <ryan@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class events_same_course_exporter extends events_exporter {

    /**
     * @var array $courseid The id of the course for these events.
     */
    protected $courseid;

    /**
     * Constructor.
     *
     * @param int $courseid The course id for these events
     * @param array $events An array of event_interface objects
     * @param array $related An array of related objects
     */
    public function __construct($courseid, array $events, $related = []) {
        parent::__construct($events, $related);
        $this->courseid = $courseid;
    }

    /**
     * Return the list of additional properties.
     *
     * @return array
     */
    protected static function define_other_properties() {
        $properties = parent::define_other_properties();
        $properties['courseid'] = ['type' => PARAM_INT];
        return $properties;
    }

    /**
     * Get the additional values to inject while exporting.
     *
     * @param renderer_base $output The renderer.
     * @return array Keys are the property names, values are their values.
     */
    protected function get_other_values(renderer_base $output) {
        $values = parent::get_other_values($output);
        $values['courseid'] = $this->courseid;
        return $values;
    }
}
