<?php
//

/**
 * Webservice token_sent event.
 *
 * @package    core
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Webservice token sent event class.
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class webservice_token_sent extends base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has been sent the web service token with id '$this->objectid'.";
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        return array(SITEID, 'webservice', 'sending requested user token', '' , 'User ID: ' . $this->userid);
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventwebservicetokensent', 'webservice');
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->context = \context_system::instance();
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'external_tokens';
    }

    public static function get_objectid_mapping() {
        // Webservices are not included in backups.
        return array('db' => 'external_tokens', 'restore' => base::NOT_MAPPED);
    }
}
