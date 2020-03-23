<?php
//

/**
 * Course module cm_info proxy.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\proxies;

defined('MOODLE_INTERNAL') || die();

/**
 * Course module stdClass proxy.
 *
 * This implementation differs from the regular std_proxy in that it takes
 * a module name and instance instead of an id to construct the proxied class.
 *
 * This is needed as the event table does not store the id of course modules
 * instead it stores the module name and instance.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cm_info_proxy implements proxy_interface {
    /** @var \stdClass */
    protected $base;
    /** @var  \cm_info */
    protected $cm;

    /**
     * cm_info_proxy constructor.
     *
     * @param string $modname The module name.
     * @param int $instance The module instance.
     * @param int $courseid course id this module belongs to
     */
    public function __construct($modname, $instance, $courseid) {
        $this->base = (object)['course' => $courseid, 'modname' => $modname, 'instance' => $instance];
    }

    /**
     * Retrieve a member of the proxied class.
     *
     * @param string $member The name of the member to retrieve
     * @return mixed The member.
     */
    public function get($member) {
        if ($this->base && property_exists($this->base, $member)) {
            return $this->base->{$member};
        }

        return $this->get_proxied_instance()->{$member};
    }

    /**
     * Get the full instance of the proxied class.
     *
     * @return \stdClass
     */
    public function get_proxied_instance() {
        if (!$this->cm) {
            $this->cm = get_fast_modinfo($this->base->course)->instances[$this->base->modname][$this->base->instance];
        }
        return $this->cm;
    }
}
