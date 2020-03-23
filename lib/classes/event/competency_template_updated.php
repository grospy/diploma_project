<?php
//

/**
 * Template updated event.
 *
 * @package    core_competency
 * @copyright  2016 Serge Gauthier <serge.gauthier.2@umontreal.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

use core\event\base;
use core_competency\template;

defined('MOODLE_INTERNAL') || die();

/**
 * Template updated event class.
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
class competency_template_updated extends base {

    /**
     * Convenience method to instantiate the event.
     *
     * Actions triggering this event will NOT trigger the underlying plan_updated for related plans.
     *
     * @param template $template The template.
     * @return self
     */
    public static final function create_from_template(template $template) {
        if (!$template->get('id')) {
            throw new \coding_exception('The template ID must be set.');
        }
        $event = static::create(array(
            'contextid'  => $template->get('contextid'),
            'objectid' => $template->get('id')
        ));
        $event->add_record_snapshot(template::TABLE, $template->to_record());
        return $event;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the template with id '$this->objectid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventtemplateupdated', 'core_competency');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return \core_competency\url::template($this->objectid, $this->contextid);
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = template::TABLE;
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
