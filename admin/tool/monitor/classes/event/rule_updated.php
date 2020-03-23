<?php
//

/**
 * The tool_monitor rule updated event.
 *
 * @package    tool_monitor
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_monitor\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The tool_monitor rule updated event class.
 *
 * @package    tool_monitor
 * @since      Moodle 2.8
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class rule_updated extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'tool_monitor_rules';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventruleupdated', 'tool_monitor');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the event monitor rule with id '$this->objectid'.";
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/tool/monitor/edit.php', array('ruleid' => $this->objectid,
            'courseid' => $this->courseid));
    }

    public static function get_objectid_mapping() {
        // No mapping required for this event because event monitor rules are not backed up.
        return array('db' => 'tool_monitor_rules', 'restore' => \core\event\base::NOT_MAPPED);
    }
}
