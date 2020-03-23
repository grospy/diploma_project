<?php
//

/**
 * Enrol instance created event.
 *
 * @package    core
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Enrol instance created event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string enrol: name of enrol method
 * }
 *
 * @package    core
 * @since      Moodle 2.9
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_instance_created extends base {

    /**
     * Api to Create new event from enrol object.
     *
     * @param \stdClass $enrol record from DB table 'enrol'
     * @return \core\event\base returns instance of new event
     */
    public static final function create_from_record($enrol) {
        $event = static::create(array(
            'context'  => \context_course::instance($enrol->courseid),
            'objectid' => $enrol->id,
            'other'    => array('enrol' => $enrol->enrol)
        ));
        return $event;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the instance of enrolment method '" .
                $this->other['enrol'] . "' with id '$this->objectid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventenrolinstancecreated', 'enrol');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/enrol/instances.php', array('id' => $this->courseid));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'enrol';
    }

    /**
     * custom validations
     *
     * Throw \coding_exception notice in case of any problems.
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['enrol'])) {
            throw new \coding_exception('The \'enrol\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'enrol', 'restore' => 'enrol');
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
