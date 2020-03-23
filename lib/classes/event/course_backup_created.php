<?php
//

/**
 * Course backup created event.
 *
 * @package    core
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Course backup created event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string format: Format of backup (moodle, imscc)
 *      - int mode: execution mode.
 *      - boolean interactive: Interactive mode (yes/no)
 *      - string type: backup type
 * }
 *
 * @package    core
 * @since      Moodle 3.4
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_backup_created extends base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = 'course';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcoursebackupcreated');
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created a backup of the course with the id '$this->objectid'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/view.php', array('id' => $this->objectid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['format'])) {
            throw new \coding_exception('The \'format\' value must be set in other.');
        }

        if (!isset($this->other['mode'])) {
            throw new \coding_exception('The \'mode\' value must be set in other.');
        }

        if (!isset($this->other['interactive'])) {
            throw new \coding_exception('The \'interactive\' value must be set in other.');
        }

        if (!isset($this->other['type'])) {
            throw new \coding_exception('The \'type\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'course', 'restore' => 'course');
    }

    public static function get_other_mapping() {
        // No need to map anything.
        return false;
    }
}
