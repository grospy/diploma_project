<?php
//

/**
 * Role assigned event.
 *
 * @package    core
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Role assigned event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - string shortname: shortname of role.
 *      - string description: (optional) role description.
 *      - string archetype: (optional) role type.
 * }
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class role_deleted extends base {
    /**
     * Initialise event parameters.
     */
    protected function init() {
        $this->data['objecttable'] = 'role';
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventroledeleted', 'role');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' deleted the role with id '$this->objectid'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/roles/manage.php');
    }

    /**
     * Returns array of parameters to be passed to legacy add_to_log() function.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array(SITEID, 'role', 'delete', 'admin/roles/manage.php?action=delete&roleid=' . $this->objectid,
            $this->other['shortname'], '');
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();

        if (!isset($this->other['shortname'])) {
            throw new \coding_exception('The \'shortname\' value must be set in other.');
        }
    }

    public static function get_objectid_mapping() {
        return array('db' => 'role', 'restore' => 'role');
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
