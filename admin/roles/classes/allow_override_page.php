<?php
//

/**
 * Role override matrix.
 *
 * @package    core_role
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Subclass of role_allow_role_page for the Allow overrides tab.
 */
class core_role_allow_override_page extends core_role_allow_role_page {
    public function __construct() {
        parent::__construct('role_allow_override', 'allowoverride');
    }

    protected function set_allow($fromroleid, $targetroleid) {
        core_role_set_override_allowed($fromroleid, $targetroleid);
    }

    protected function get_cell_tooltip($fromrole, $targetrole) {
        $a = new stdClass;
        $a->fromrole = $fromrole->localname;
        $a->targetrole = $targetrole->localname;
        return get_string('allowroletooverride', 'core_role', $a);
    }

    public function get_intro_text() {
        return get_string('configallowoverride2', 'core_admin');
    }

    protected function get_eventclass() {
        return \core\event\role_allow_override_updated::class;
    }
}
