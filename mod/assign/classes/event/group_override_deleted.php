<?php
//

/**
 * The mod_assign group override deleted event.
 *
 * @package    mod_assign
 * @copyright  2016 Ilya Tregubov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_assign\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_assign group override deleted event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int assignid: the id of the assign.
 *      - int groupid: the id of the group.
 * }
 *
 * @package    mod_assign
 * @since      Moodle 3.2
 * @copyright  2016 Ilya Tregubov
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class group_override_deleted extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'assign_overrides';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventoverridedeleted', 'mod_assign');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the override with id '$this->objectid' for the assign with " .
            "course module id '$this->contextinstanceid' for the group with id '{$this->other['groupid']}'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/assign/overrides.php', array('cmid' => $this->contextinstanceid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['assignid'])) {
            throw new \coding_exception('The \'assignid\' value must be set in other.');
        }

        if (!isset($this->other['groupid'])) {
            throw new \coding_exception('The \'groupid\' value must be set in other.');
        }
    }

    /**
     * Get objectid mapping
     */
    public static function get_objectid_mapping() {
        return array('db' => 'assign_overrides', 'restore' => 'assign_override');
    }

    /**
     * Get other mapping
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['assignid'] = array('db' => 'assign', 'restore' => 'assign');
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');

        return $othermapped;
    }
}
