<?php
//

/**
 * Group unassigned from grouping event.
 *
 * @package    core
 * @copyright  2016 Vadim Dvorovenko
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Group unassigned from grouping event class.
 *
 * @package    core
 * @since      Moodle 3.1
 * @copyright  2016 Vadim Dvorovenko
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grouping_group_unassigned extends base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' unassigned the group with id '{$this->other['groupid']}'" .
                " from the grouping with id '$this->objectid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgroupinggroupunassigned', 'group');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/group/assign.php', array('id' => $this->objectid));
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

    /**
     * This is used when restoring course logs where it is required that we
     * map the objectid to its new value in the new course.
     *
     * @return string the name of the restore mapping the objectid links to
     */
    public static function get_objectid_mapping() {
        return array('db' => 'groupings', 'restore' => 'group');
    }

    /**
     * This is used when restoring course logs where it is required that we
     * map the information in 'other' to its new value in the new course.
     *
     * @return array an array of other values and their corresponding mapping
     */
    public static function get_other_mapping() {
        $othermapped = array();
        $othermapped['groupid'] = array('db' => 'groups', 'restore' => 'group');
        return $othermapped;
    }
}
