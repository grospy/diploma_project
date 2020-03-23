<?php
//

/**
 * Grouping deleted event.
 *
 * @package    core
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Grouping deleted event class.
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grouping_deleted extends base {

    /**
     * Legacy data.
     *
     * @var mixed
     */
    protected $legacydata;

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the grouping with id '$this->objectid'.";
    }

    /**
     * Legacy event data if get_legacy_eventname() is not empty.
     *
     * @return \stdClass
     */
    protected function get_legacy_eventdata() {
        return $this->get_record_snapshot('groupings', $this->objectid);
    }

    /**
     * Return the legacy event name.
     *
     * @return string
     */
    public static function get_legacy_eventname() {
        return 'groups_grouping_deleted';
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgroupingdeleted', 'group');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/group/groupings.php', array('id' => $this->courseid));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'groupings';
    }

    public static function get_objectid_mapping() {
        return array('db' => 'groupings', 'restore' => 'grouping');
    }
}
