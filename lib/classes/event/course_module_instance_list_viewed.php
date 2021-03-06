<?php
//

/**
 * Course module instance list viewed event.
 *
 * @package    core
 * @copyright  2013 onwards Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Course module instance list viewed event class.
 *
 * This is an abstract to guide the developers in using this event name for their events.
 * It is intended to be used when the user viewes the list of all the instances of a module
 * in a course. This replaces the historical 'view all' log entry generated in mod/somemod/index.php.
 *
 * Example:
 *
 *     \mod_chat\event\course_module_instance_list_viewed extends \core\event\course_module_instance_list_viewed
 *
 * @package    core
 * @since      Moodle 2.7
 * @copyright  2013 onwards Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class course_module_instance_list_viewed extends base{

    /** @var string protected var to store mod name */
    protected $modname;

    /**
     * Init method.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        if (strstr($this->component, 'mod_') === false) {
            throw new \coding_exception('The event name or namespace is invalid.');
        } else {
            $this->modname = str_replace('mod_', '', $this->component);
        }
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' viewed the instance list for the module '$this->modname' in the course " .
            "with id '$this->courseid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcoursemoduleinstancelistviewed', 'core');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url("/mod/$this->modname/index.php", array('id' => $this->courseid));
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, $this->modname, 'view all', 'index.php?id=' . $this->courseid, '');
    }


    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if ($this->contextlevel != CONTEXT_COURSE) {
            throw new \coding_exception('Context level must be CONTEXT_COURSE.');
        }
    }
}
