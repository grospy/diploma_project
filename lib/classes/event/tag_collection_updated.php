<?php
//

/**
 * Tag collection updated event.
 *
 * @package    core
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Tag collection updated event class.
 *
 * @package    core
 * @since      Moodle 3.0
 * @copyright  2015 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tag_collection_updated extends base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['objecttable'] = 'tag_coll';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Utility method to create new event.
     *
     * @param object $tagcoll
     * @return user_graded
     */
    public static function create_from_record($tagcoll) {
        $event = self::create(array(
            'objectid' => $tagcoll->id,
            'context' => \context_system::instance(),
        ));
        $event->add_record_snapshot('tag_coll', $tagcoll);
        return $event;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventtagcollupdated', 'core_tag');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the tag collection with id '$this->objectid'";
    }
}
