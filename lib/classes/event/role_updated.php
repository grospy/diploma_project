<?php
//

/**
 * Role updated event.
 *
 * @package    core
 * @copyright  2019 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Role updated event class.
 *
 * @package    core
 * @since      Moodle 3.8
 * @copyright  2019 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class role_updated extends base {
    /**
     * Initialise event parameters.
     */
    protected function init() {
        $this->data['objecttable'] = 'role';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventroleupdated', 'role');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' updated the role with id '$this->objectid'.";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/roles/define.php', ['action' => 'edit', 'roleid' => $this->objectid]);
    }

    /**
     * Returns array of parameters to be passed to legacy add_to_log() function.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return [SITEID, 'role', 'update', 'admin/roles/manage.php?action=edit&roleid=' . $this->objectid,
            $this->other['shortname'], ''];
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
}
