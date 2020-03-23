<?php
//

/**
 * Privacy Subsystem implementation for block_online_users.
 *
 * @package    block_online_users
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_online_users\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\writer;
use core_privacy\local\request\transform;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem for block_online_users.
 *
 * @copyright  2018 Zig Tan <zig@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        \core_privacy\local\metadata\provider,
        \core_privacy\local\request\user_preference_provider {

    /**
     * Describe all the places where this plugin stores personal data.
     *
     * @param collection $collection Collection of items to add metadata to.
     * @return collection Collection with our added items.
     */
    public static function get_metadata(collection $collection) : collection {

        $collection->add_user_preference('block_online_users_uservisibility',
                'privacy:metadata:preference:uservisibility');

        return $collection;
    }

    /**
     * Export user preferences controlled by this plugin.
     *
     * @param int $userid ID of the user we are exporting data form.
     */
    public static function export_user_preferences(int $userid) {

        $uservisibility = get_user_preferences('block_online_users_uservisibility', 1, $userid);

        writer::export_user_preference('block_online_users',
                'block_online_users_uservisibility', transform::yesno($uservisibility),
                get_string('privacy:metadata:preference:uservisibility', 'block_online_users'));
    }
}
