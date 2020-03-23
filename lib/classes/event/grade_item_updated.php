<?php
//

/**
 * Grade item updated event.
 *
 * @package    core
 * @copyright  2019 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Grade item updated event class.
 *
 * @package    core
 * @since      Moodle 3.8
 * @copyright  2019 Dmitrii Metelkin <dmitriim@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_item_updated extends grade_item_created {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'grade_items';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventgradeitemupdated', 'core_grades');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '" . $this->userid . "' updated a grade item with id '" . $this->objectid . "'" .
            " of type '" . $this->other['itemtype'] . "' and name '" . $this->other['itemname'] . "'" .
            " in the course with the id '" . $this->courseid . "'.";
    }

}
