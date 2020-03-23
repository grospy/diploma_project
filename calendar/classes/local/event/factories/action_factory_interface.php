<?php
//

/**
 * Action factory interface.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\factories;

defined('MOODLE_INTERNAL') || die();

interface action_factory_interface {
    /**
     * Creates an instance of an action.
     *
     * @param string      $name       The action's name.
     * @param \moodle_url $url        The action's URL.
     * @param int         $itemcount  The number of items needing action.
     * @param bool        $actionable The action's actionability.
     * @return \core_calendar\local\event\entities\action_interface The action.
     */
    public function create_instance($name, \moodle_url $url, $itemcount, $actionable);
}
