<?php
//

/**
 * Custom field created event.
 *
 * @package    core_customfield
 * @copyright  2018 Daniel Neis Araujo <daniel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield\event;

use core_customfield\field_controller;

defined('MOODLE_INTERNAL') || die();

/**
 * Custom field created event class.
 *
 * @package    core_customfield
 * @since      Moodle 3.6
 * @copyright  2018 Daniel Neis Araujo <daniel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_created extends \core\event\base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = 'customfield_field';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Creates an instance from a field controller object
     *
     * @param field_controller $field
     * @return field_created
     */
    public static function create_from_object(field_controller $field) : field_created {
        $eventparams = [
            'objectid' => $field->get('id'),
            'context'  => $field->get_handler()->get_configuration_context(),
            'other'    => [
                'shortname' => $field->get('shortname'),
                'name'      => $field->get('name')
            ]
        ];
        $event = self::create($eventparams);
        $event->add_record_snapshot($event->objecttable, $field->to_record());
        return $event;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventfieldcreated', 'core_customfield');
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the field with id '$this->objectid'.";
    }
}
