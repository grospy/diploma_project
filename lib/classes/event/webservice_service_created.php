<?php
//

/**
 * Web service service created event.
 *
 * @package    core
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Web service service created event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string sessionid: (optional) session id.
 * }
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class webservice_service_created extends base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' created the web service with id '$this->objectid'.";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        global $CFG;
        $service = $this->get_record_snapshot('external_services', $this->objectid);
        return array(SITEID, 'webservice', 'add', $CFG->wwwroot . "/" . $CFG->admin . "/settings.php?section=externalservices",
            get_string('addservice', 'webservice', $service));
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventwebserviceservicecreated', 'webservice');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/settings.php', array('section' => 'externalservices'));
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->context = \context_system::instance();
        $this->data['crud'] = 'c';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'external_services';
    }

    public static function get_objectid_mapping() {
        // Webservices are not included in the backups.
        return array('db' => 'external_services', 'restore' => NOT_MAPPED);
    }

    public static function get_other_mapping() {
        return false;
    }
}
