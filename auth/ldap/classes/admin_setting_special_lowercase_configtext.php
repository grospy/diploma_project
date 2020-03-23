<?php
//

/**
 * Special setting for auth_ldap that lowercases values on save..
 *
 * @package    auth_ldap
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Special setting for auth_ldap that lowercases values on save..
 *
 * @package    auth_ldap
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_ldap_admin_setting_special_lowercase_configtext extends admin_setting_configtext {

    /**
     * We need to convert the data to lowercase prior to save.
     *
     * @param string $data Form data.
     * @return string Empty when no errors.
     */
    public function write_setting($data) {
        return parent::write_setting(core_text::strtolower($data));
    }
}
