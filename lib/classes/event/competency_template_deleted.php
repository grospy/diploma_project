<?php
//

/**
 * Template deleted event.
 *
 * @package    core_competency
 * @copyright  2016 Serge Gauthier
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

use core\event\base;
use core_competency\template;

defined('MOODLE_INTERNAL') || die();

/**
 * Template deleted event class.
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
class competency_template_deleted extends base {

    /**
     * Convenience method to instantiate the event.
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
        return "The user with id '$this->userid' deleted the template with id '$this->objectid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventtemplatedeleted', 'core_competency');
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = template::TABLE;;
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
