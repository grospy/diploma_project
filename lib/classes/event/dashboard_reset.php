<?php
//

/**
 * Dashboard reset event.
 *
 * @package    core
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Dashboard reset event class.
 *
 * Class for event to be triggered when a dashboard is reset.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string private: Either MY_PAGE_PRIVATE or MY_PAGE_PUBLIC.
 *      - string pagetype: Either my-index or user-profile.
 * }
 *
 * @package    core
 * @since      Moodle 3.2
 * @copyright  2016 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class dashboard_reset extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;

    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has reset their dashboard";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventdashboardreset', 'core');
    }

}
