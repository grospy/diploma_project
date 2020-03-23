<?php
//

/**
 * Privacy Subsystem implementation for theme_boost.
 *
 * @package    theme_boost
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_boost\privacy;

use \core_privacy\local\metadata\collection;

defined('MOODLE_INTERNAL') || die();

/**
 * The boost theme stores a user preference data.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    // This plugin has data.
    \core_privacy\local\metadata\provider,
    // This plugin has some sitewide user preferences to export.
    \core_privacy\local\request\user_preference_provider {

    /** The user preference for the navigation drawer. */
    const DRAWER_OPEN_NAV = 'drawer-open-nav';

    /**
     * Returns meta data about this system.
     *
     * @param  collection $items The initialised item collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $items) : collection {
        $items->add_user_preference(self::DRAWER_OPEN_NAV, 'privacy:metadata:preference:draweropennav');
        return $items;
    }

    /**
     * Store all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $draweropennavpref = get_user_preferences(self::DRAWER_OPEN_NAV, null, $userid);

        if (isset($draweropennavpref)) {
            $preferencestring = get_string('privacy:drawernavclosed', 'theme_boost');
            if ($draweropennavpref == 'true') {
                $preferencestring = get_string('privacy:drawernavopen', 'theme_boost');
            }
            \core_privacy\local\request\writer::export_user_preference(
                'theme_boost',
                self::DRAWER_OPEN_NAV,
                $draweropennavpref,
                $preferencestring
            );
        }
    }
}
