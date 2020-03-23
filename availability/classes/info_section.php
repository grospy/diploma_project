<?php
//

/**
 * Class handles conditional availability information for a section.
 *
 * @package core_availability
 * @copyright 2014 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_availability;

defined('MOODLE_INTERNAL') || die();

/**
 * Class handles conditional availability information for a section.
 *
 * @package core_availability
 * @copyright 2014 The Open University
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class info_section extends info {
    /** @var \section_info Section. */
    protected $section;

    /**
     * Constructs with item details.
     *
     * @param \section_info $section Section object
     */
    public function __construct(\section_info $section) {
        parent::__construct($section->modinfo->get_course(), $section->visible,
                $section->availability);
        $this->section = $section;
    }

    protected function get_thing_name() {
        return get_section_name($this->section->course, $this->section->section);
    }

    public function get_context() {
        return \context_course::instance($this->get_course()->id);
    }

    protected function get_view_hidden_capability() {
        return 'moodle/course:ignoreavailabilityrestrictions';
    }

    protected function set_in_database($availability) {
        global $DB;

        $section = new \stdClass();
        $section->id = $this->section->id;
        $section->availability = $availability;
        $section->timemodified = time();
        $DB->update_record('course_sections', $section);
    }

    /**
     * Gets the section object. Intended for use by conditions.
     *
     * @return \section_info Section
     */
    public function get_section() {
        return $this->section;
    }

}
