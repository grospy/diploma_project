<?php
//

/**
 * Custom field category updated event.
 *
 * @package    core_customfield
 * @copyright  2018 Daniel Neis Araujo <daniel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_customfield\event;

use core_customfield\category_controller;

defined('MOODLE_INTERNAL') || die();

/**
 * Custom field category updated event class.
 *
 * @package    core_customfield
 * @since      Moodle 3.6
 * @copyright  2018 Daniel Neis Araujo <daniel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category_updated extends \core\event\base {

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = 'customfield_category';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Creates an instance from a category controller object
     *
     * @param category_controller $category
     * @return category_updated
     */
    public static function create_from_object(category_controller $category) : category_updated {
        $eventparams = [
            'objectid' => $category->get('id'),
            'context'  => $category->get_handler()->get_configuration_context(),
            'other'    => ['name' => $category->get('name')]
        ];
        $event = self::create($eventparams);
        $event->add_record_snapshot($event->objecttable, $category->to_record());
        return $event;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcategoryupdated', 'core_customfield');
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the category with id '$this->objectid'.";
    }
}
