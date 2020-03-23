<?php
//

/**
 * Course section deleted event.
 *
 * @package    core
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Course section deleted event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int sectionnum: section number.
 *      - string sectionname: section name.
 * }
 *
 * @package    core
 * @since      Moodle 3.1
 * @copyright  2015 Ruslan Kabalin, Lancaster University.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_section_deleted extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'course_sections';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcoursesectiondeleted');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted section number '{$this->other['sectionnum']}' " .
                "(section name '{$this->other['sectionname']}') for the course with id '$this->courseid'";
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, 'course', 'delete section', 'view.php?id=' . $this->courseid, $this->other['sectionnum']);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['sectionnum'])) {
            throw new \coding_exception('The \'sectionnum\' value must be set in other.');
        }
        if (!isset($this->other['sectionname'])) {
            throw new \coding_exception('The \'sectionname\' value must be set in other.');
        }
    }
}
