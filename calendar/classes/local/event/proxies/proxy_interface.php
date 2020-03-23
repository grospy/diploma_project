<?php
//

/**
 * Proxy interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\proxies;

defined('MOODLE_INTERNAL') || die();

/**
 * Interface for a proxy class.
 *
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface proxy_interface {
    /**
     * Retrieve a member of the proxied class.
     *
     * @param string $member The name of the member to retrieve
     * @throws \core_calendar\local\event\exceptions\member_does_not_exist_exception If the proxied class does not have the
     *                                                                               requested member.
     * @return mixed The member.
     */
    public function get($member);

    /**
     * Get the full instance of the proxied class.
     *
     * @return \stdClass
     */
    public function get_proxied_instance();
}
