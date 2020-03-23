<?php
//

/**
 * Special settings for auth_db password_link.
 *
 * @package    auth_db
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Special settings for auth_db password_link.
 *
 * @package    auth_db
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_db_admin_setting_special_auth_configtext extends admin_setting_configtext {

    /**
     * We need to overwrite the global "alternate login url" setting if wayf is enabled.
     *
     * @param string $data Form data.
     * @return string Empty when no errors.
     */
    public function write_setting($data) {

        if (get_config('auth_db', 'passtype') === 'internal') {
            // We need to clear the auth_db change password link.
            $data = '';
        }

        return parent::write_setting($data);
    }
}
