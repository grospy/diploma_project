<?php
//

/**
 * The mod_workshop assessment evaluated event.
 *
 * @package    mod_workshop
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_workshop\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_workshop assessment evaluated event class.
 *
 * @property-read array $other {
 *      Extra information about the event.
 *
 *      - string currentgrade: (may be null) current saved grade.
 *      - string finalgrade: (may be null) final grade.
 * }
 *
 * @package    mod_workshop
 * @since      Moodle 2.7
 * @copyright  2013 Adrian Greeve
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assessment_evaluated extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'workshop_aggregations';
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has had their assessment attempt evaluated for the workshop with " .
            "course module id '$this->contextinstanceid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventassessmentevaluated', 'mod_workshop');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/workshop/view.php', array('id' => $this->contextinstanceid));
    }

    public static function get_objectid_mapping() {
        return array('db' => 'workshop_aggregations', 'restore' => 'workshop_aggregation');
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
