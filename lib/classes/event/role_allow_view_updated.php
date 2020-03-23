<?php
//

/**
 * Role allow view updated event.
 *
 * @package    core
 * @since      Moodle 3.4
 * @copyright  2017 Andrew Hancox <andrewdchancox@googlemail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Role allow view updated event class.
 *
 * @package    core
 * @since      Moodle 2.6
 * @copyright  2013 Rajesh Taneja <rajesh@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class role_allow_view_updated extends base {
    /**
     * Initialise event parameters.
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'role_allow_view';
    }

    /**
     * Returns localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventroleallowviewupdated', 'role');
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        $action = ($this->other['allow']) ? 'allow' : 'stop allowing';
        return "The user with id '$this->userid' modified the role with id '" . $this->other['targetroleid']
            . "' to $action users with that role from viewing the role with id '" . $this->objectid . "' to users";
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/admin/roles/allow.php', array('mode' => 'view'));
    }

    /**
     * Returns array of parameters to be passed to legacy add_to_log() function.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array(SITEID, 'role', 'edit allow view', 'admin/roles/allow.php?mode=view');
    }
}
