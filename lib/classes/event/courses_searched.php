<?php
//

/**
 * Courses searched event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Courses searched event class.
 *
 * Class for event to be triggered when a courses are searched (using course search).
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string query: search query performed.
 * }
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class courses_searched extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {

        return "The user with id '$this->userid' searched course information for the term '".$this->other['query']."'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcoursessearched', 'core');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url|null
     */
    public function get_url() {
        return new \moodle_url('/course/search.php', array('search' => $this->other['query']));
    }

    /**
     * Custom validations.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['query'])) {
            throw new \coding_exception('The \'query\' must be set in other.');
        }
    }

    /**
     * Used for maping events on restore
     *
     * @return bool
     */
    public static function get_other_mapping() {
        // No mapping required.
        return false;
    }
}
