<?php
//

/**
 * Event factory class.
 *
 * @package    core_calendar
 * @copyright  2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_calendar\local\event\factories;

defined('MOODLE_INTERNAL') || die();

use core_calendar\local\event\exceptions\invalid_callback_exception;
use core_calendar\local\event\entities\event_interface;

/**
 * Event factory class.
 *
 * @copyright 2017 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_factory extends event_abstract_factory {

    protected function apply_component_action(event_interface $event) {
        $callbackapplier = $this->actioncallbackapplier;
        $callbackresult = $callbackapplier($event);

        if (!$callbackresult instanceof event_interface) {
            throw new invalid_callback_exception(
                'Event factory action callback applier must return an instance of event_interface');
        }

        return $callbackresult;
    }

    protected function expose_event(event_interface $event) {
        $callbackapplier = $this->visibilitycallbackapplier;
        $callbackresult = $callbackapplier($event);

        if (!is_bool($callbackresult)) {
            throw new invalid_callback_exception('Event factory visibility callback applier must return true or false');
        }

        return $callbackresult === true ? $event : null;
    }
}
