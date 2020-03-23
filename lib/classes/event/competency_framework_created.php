<?php
//

/**
 * Competency framework created event.
 *
 * @package    core_competency
 * @copyright  2016 Serge Gauthier <serge.gauthier.2@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\event;

use core\event\base;
use core_competency\competency_framework;

defined('MOODLE_INTERNAL') || die();

/**
 * Competency framework created event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 * }
 *
 * @package    core_competency
 * @since      Moodle 3.1
 * @copyright  2016 Serge Gauthier <serge.gauthier.2@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class competency_framework_created extends base {

    /**
     * Convenience method to instantiate the event.
     *
     * @param competency_framework $framework The framework.
     * @return self
     */
    public static final function create_from_framework(competency_framework $framework) {
        if (!$framework->get('id')) {
            throw new \coding_exception('The competency framework ID must be set.');
        }
        $event = static::create(array(
            'contextid'  => $framework->get('contextid'),
            'objectid' => $framework->get('id')
        ));
        $event->add_record_snapshot(competency_framework::TABLE, $framework->to_record());
        return $event;
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventcompetencyframeworkcreated', 'core_competency');
    }

    /**
     * Returns non-localised description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the competency framework with id '$this->objectid'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return \core_competency\url::framework($this->objectid, $this->contextid);
    }

    /**
     * Initialise the event data.
     */
    protected function init() {
        $this->data['objecttable'] = competency_framework::TABLE;
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Get_objectid_mapping method.
     *
     * @return string the name of the restore mapping the objectid links to
     */
    public static function get_objectid_mapping() {
        return base::NOT_MAPPED;
    }

}
