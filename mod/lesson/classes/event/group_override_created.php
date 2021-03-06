<?php
//

/**
 * The mod_lesson group override created event.
 *
 * @package    mod_lesson
 * @copyright  2015 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_lesson\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_lesson group override created event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int lessonid: the id of the lesson.
 *      - int groupid: the id of the group.
 * }
 *
 * @package    mod_lesson
 * @since      Moodle 2.9
 * @copyright  2015 Jean-Michel Vedrine
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class group_override_created extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'lesson_overrides';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventoverridecreated', 'mod_lesson');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the override with id '$this->objectid' for the lesson with " .
            "course module id '$this->contextinstanceid' for the group with id '{$this->other['groupid']}'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/lesson/overrideedit.php', array('id' => $this->objectid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['lessonid'])) {
            throw new \coding_exception('The \'lessonid\' value must be set in other.');
        }

        if (!isset($this->other['groupid'])) {
            throw new \coding_exception('The \'groupid\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'lesson_overrides', 'restore' => 'lesson_override');
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['lessonid'] = array('db' => 'lesson', 'restore' => 'lesson');
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');

        return $othermapped;
    }
}
