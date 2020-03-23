<?php
//
/**
 * Privacy Subsystem implementation for core_my.
 *
 * @package    core_my
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_my\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\context;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\writer;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for core_my implementing metadata, plugin, and user_preference providers.
 *
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\user_preference_provider {

    /**
     * Returns meta data about this system.
     *
     * @param   collection $collection The initialised collection to add items to.
     * @return  collection     A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_user_preference(
            'user_home_page_preference',
            'privacy:metadata:core_my:preference:user_home_page_preference'
        );

        return $collection;
    }

    /**
     * Export all user preferences for the plugin.
     *
     * @param   int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $userhomepagepreference = get_user_preferences('user_home_page_preference', null, $userid);

        if (null !== $userhomepagepreference) {
            writer::export_user_preference(
                'core_my',
                'user_home_page_preference',
                $userhomepagepreference,
                get_string('privacy:metadata:core_my:preference:user_home_page_preference', 'core_my')
            );
        }
    }

}
