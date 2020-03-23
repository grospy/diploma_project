<?php
//

/**
 * Special setting for auth_ldap that cleans up context values on save..
 *
 * @package    auth_ldap
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Special setting for auth_ldap that cleans up context values on save..
 *
 * @package    auth_ldap
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_ldap_admin_setting_special_contexts_configtext extends admin_setting_configtext {

    /**
     * We need to remove duplicates on save to prevent issues in other areas of Moodle.
     *
     * @param string $data Form data.
     * @return string Empty when no errors.
     */
    public function write_setting($data) {
        // Try to remove duplicates before storing the contexts (to avoid problems in sync_users()).
        $data = explode(';', $data);
        $data = array_map(function($x) {
            return core_text::strtolower(trim($x));
        }, $data);
        $data = implode(';', array_unique($data));
        return parent::write_setting($data);
    }
}
