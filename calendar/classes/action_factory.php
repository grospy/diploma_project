<?php
//

/**
 * Action factory.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar;

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\factories\action_factory_interface;
use core_calendar\local\event\value_objects\action;

/**
 * Action factory class.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class action_factory implements action_factory_interface {

    public function create_instance($name, \moodle_url $url, $itemcount, $actionable) {
        return new action ($name, $url, $itemcount, $actionable);
    }
}
