<?php
//

/**
 * Recycle bin events.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_recyclebin\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Event class.
 *
 * @package    tool_recyclebin
 * @copyright  2015 University of Kent
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class category_bin_item_created extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['objecttable'] = 'tool_recyclebin_category';
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventitemcreated', 'tool_recyclebin');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return get_string('eventitemcreated_desc', 'tool_recyclebin', array(
            'objectid' => $this->objectid
        ));
    }
}
