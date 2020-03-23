<?php
//

/**
 * Default completion for activity in a course updated event
 *
 * @package    core
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Default completion for activity in a course updated event
 *
 * @package    core
 * @since      Moodle 3.3
 * @copyright  2017 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class completion_defaults_updated extends base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = 'course_completion_defaults';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventdefaultcompletionupdated', 'completion');
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/defaultcompletion.php', array('id' => $this->courseid));
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the default completion for module " .
            "'{$this->other['modulename']}' in course with id '$this->courseid'.";
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     */
    protected function validate_data() {
        parent::validate_data();
        if ($this->contextlevel != CONTEXT_COURSE) {
            throw new \coding_exception('Context passed must be course context.');
        }
        if (!isset($this->other['modulename'])) {
            throw new \coding_exception('The \'modulename\' value must be set in other.');
        }
    }

    /**
     * This is used when restoring course logs where it is required that we
     * map the objectid to it's new value in the new course.
     *
     * @return array
     */
    public static function get_objectid_mapping() {
        parent::get_objectid_mapping();
        return array('db' => 'course_completion_defaults', 'restore' => 'course_completion_defaults');
    }
}
