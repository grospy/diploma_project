<?php
//

/**
 * The tool_monitor subscription deleted event.
 *
 * @package    tool_monitor
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_monitor\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The tool_monitor subscription deleted event class.
 *
 * @package    tool_monitor
 * @since      Moodle 2.8
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class subscription_deleted extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'tool_monitor_subscriptions';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubdeleted', 'tool_monitor');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the event monitor subscription with id '$this->objectid'.";
    }

    public static function get_objectid_mapping() {
        // No mapping required for this event because event monitor subscriptions are not backed up.
        return array('db' => 'tool_monitor_subscriptions', 'restore' => \core\event\base::NOT_MAPPED);
    }
}
