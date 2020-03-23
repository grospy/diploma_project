<?php
//

/**
 * Data provider.
 *
 * @package    core_auth
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_auth\privacy;
defined('MOODLE_INTERNAL') || die();

use context;
use core_privacy\local\metadata\collection;
use core_privacy\local\request\transform;
use core_privacy\local\request\writer;

/**
 * Data provider class.
 *
 * @package    core_auth
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\user_preference_provider {

    /**
     * Returns metadata.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {

        $collection->add_user_preference('auth_forcepasswordchange', 'privacy:metadata:userpref:forcepasswordchange');
        $collection->add_user_preference('create_password', 'privacy:metadata:userpref:createpassword');
        $collection->add_user_preference('login_failed_count', 'privacy:metadata:userpref:loginfailedcount');
        $collection->add_user_preference('login_failed_count_since_success',
            'privacy:metadata:userpref:loginfailedcountsincesuccess');
        $collection->add_user_preference('login_failed_last', 'privacy:metadata:userpref:loginfailedlast');
        $collection->add_user_preference('login_lockout', 'privacy:metadata:userpref:loginlockout');
        $collection->add_user_preference('login_lockout_ignored', 'privacy:metadata:userpref:loginlockoutignored');
        $collection->add_user_preference('login_lockout_secret', 'privacy:metadata:userpref:loginlockoutsecret');

        return $collection;
    }

    /**
     * Export all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {

        $yesno = function($v) {
            return transform::yesno($v);
        };
        $datetime = function($v) {
            return $v ? transform::datetime($v) : null;
        };

        $prefs = [
            ['auth_forcepasswordchange', 'forcepasswordchange', $yesno],
            ['create_password', 'createpassword', $yesno],
            ['login_failed_count', 'loginfailedcount', null],
            ['login_failed_count_since_success', 'loginfailedcountsincesuccess', null],
            ['login_failed_last', 'loginfailedlast', $datetime],
            ['login_lockout', 'loginlockout', $datetime],
            ['login_lockout_ignored', 'loginlockoutignored', $yesno],
            ['login_lockout_secret', 'loginlockoutsecret', null],
        ];

        foreach ($prefs as $prefdata) {
            list($prefname, $langkey, $transformer) = $prefdata;
            $value = get_user_preferences($prefname, null, $userid);
            if ($value === null) {
                continue;
            }
            writer::export_user_preference('core_auth', $prefname, $transformer ? $transformer($value) : $value,
                get_string("privacy:metadata:userpref:{$langkey}", 'core_auth'));
        }
    }

}
