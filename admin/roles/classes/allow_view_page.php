<?php
//

/**
 * Role view matrix.
 *
 * @package    core_role
 * @copyright  2016 onwards Andrew Hancox <andrewdchancox@googlemail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Subclass of role_allow_role_page for the Allow views tab.
 *
 * @package    core_role
 * @copyright  2016 onwards Andrew Hancox <andrewdchancox@googlemail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_role_allow_view_page extends core_role_allow_role_page {
    /** @var array */
    protected $allowedtargetroles;

    /**
     * core_role_allow_view_page constructor.
     */
    public function __construct() {
        parent::__construct('role_allow_view', 'allowview');
    }


    /**
     * Allow from role to view target role.
     * @param int $fromroleid
     * @param int $targetroleid
     */
    protected function set_allow($fromroleid, $targetroleid) {
        core_role_set_view_allowed($fromroleid, $targetroleid);
    }

    /**
     * Get tool tip for cell.
     * @param string $fromrole
     * @param string $targetrole
     * @return string
     * @throws \coding_exception
     */
    protected function get_cell_tooltip($fromrole, $targetrole) {
        $a = new stdClass;
        $a->fromrole = $fromrole->localname;
        $a->targetrole = $targetrole->localname;
        return get_string('allowroletoview', 'core_role', $a);
    }

    /**
     * Get intro text for role allow view page.
     * @return string
     * @throws \coding_exception
     */
    public function get_intro_text() {
        return get_string('configallowview', 'core_admin');
    }

    protected function get_eventclass() {
        return \core\event\role_allow_view_updated::class;
    }
}
