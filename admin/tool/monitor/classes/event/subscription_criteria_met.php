<?php
//

/**
 * The tool_monitor subscription criteria met event.
 *
 * @package    tool_monitor
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_monitor\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The tool_monitor subscription criteria met event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string subscriptionid: id of the subscription.
 * }
 *
 * @package    tool_monitor
 * @since      Moodle 2.8
 * @copyright  2014 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class subscription_criteria_met extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubcriteriamet', 'tool_monitor');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The criteria for the subscription with id '{$this->other['subscriptionid']}' was met.";
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['subscriptionid'])) {
            throw new \coding_exception('The \'subscriptionid\' value must be set in other.');
        }
    }

    public static function get_other_mapping() {
        // No mapping required for this event because event monitor subscriptions are not backed up.
        return false;
    }
}
