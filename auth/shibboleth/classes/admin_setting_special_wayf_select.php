<?php
//

/**
 * Special settings for auth_shibboleth WAYF.
 *
 * @package    auth_shibboleth
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Special settings for auth_shibboleth WAYF.
 *
 * @package    auth_shibboleth
 * @copyright  2017 Stephen Bourget
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_shibboleth_admin_setting_special_wayf_select extends admin_setting_configselect {

    /**
     * Calls parent::__construct with specific arguments.
     */
    public function __construct() {
        $yesno = array();
        $yesno['off'] = new lang_string('no');
        $yesno['on'] = new lang_string('yes');
        parent::__construct('auth_shibboleth/alt_login',
                new lang_string('auth_shib_integrated_wayf', 'auth_shibboleth'),
                new lang_string('auth_shib_integrated_wayf_description', 'auth_shibboleth'),
                'off',
                $yesno);
    }

    /**
     * We need to overwrite the global "alternate login url" setting if wayf is enabled.
     *
     * @param string $data Form data.
     * @return string Empty when no errors.
     */
    public function write_setting($data) {
        global $CFG;

        // Overwrite alternative login URL if integrated WAYF is used.
        if (isset($data) && $data == 'on') {
            set_config('alt_login', $data, 'auth_shibboleth');
            set_config('alternateloginurl', $CFG->wwwroot.'/auth/shibboleth/login.php');
        } else {
            // Check if integrated WAYF was enabled and is now turned off.
            // If it was and only then, reset the Moodle alternate URL.
            $oldsetting = get_config('auth_shibboleth', 'alt_login');
            if (isset($oldsetting) and $oldsetting == 'on') {
                set_config('alt_login', 'off', 'auth_shibboleth');
                set_config('alternateloginurl', '');
            }
            $data = 'off';
        }
        return parent::write_setting($data);
    }
}
