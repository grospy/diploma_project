<?php
//

/**
 * Group member added event.
 *
 * @package    core
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Group member added event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string component: name of component
 *      - int itemid: id of item.
 * }
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class group_member_added extends base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' added the user with id '$this->relateduserid' to the group with " .
            "id '$this->objectid'.";
    }

    /**
     * Legacy event data if get_legacy_eventname() is not empty.
     *
     * @return \stdClass
     */
    protected function get_legacy_eventdata() {
        $eventdata = new \stdClass();
        $eventdata->groupid = $this->objectid;
        $eventdata->userid  = $this->relateduserid;
        $eventdata->component = $this->other['component'];
        $eventdata->itemid = $this->other['itemid'];
        return $eventdata;
    }

    /**
     * Return the legacy event name.
     *
     * @return string
     */
    public static function get_legacy_eventname() {
        return 'groups_member_added';
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgroupmemberadded', 'group');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/group/members.php', array('group' => $this->objectid));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'groups';
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->relateduserid)) {
            throw new \coding_exception('The \'relateduserid\' must be set.');
        }

        if (!isset($this->other['component'])) {
            throw new \coding_exception('The \'component\' value must be set in other, even if empty.');
        }

        if (!isset($this->other['itemid'])) {
            throw new \coding_exception('The \'itemid\' value must be set in other, even if empty.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'groups', 'restore' => 'group');
    }

    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['itemid'] = base::NOT_MAPPED;

        return $othermapped;
    }
}
