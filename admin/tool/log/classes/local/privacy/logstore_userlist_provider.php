<?php
//

/**
 * Logstore userlist provider interface.
 *
 * @package    tool_log
 * @copyright  2018 Adrian Greeve
 * @author     Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_log\local\privacy;
defined('MOODLE_INTERNAL') || die();

/**
 * Logstore userlist provider interface.
 *
 * Logstore subplugins providers must implement this interface.
 *
 * @package    tool_log
 * @copyright  2018 Adrian Greeve
 * @author     Adrian Greeve <adriangreeve.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface logstore_userlist_provider extends
        \core_privacy\local\request\plugin\subplugin_provider,
        \core_privacy\local\request\shared_userlist_provider
    {

    /**
     * Add user IDs that contain user information for the specified context.
     *
     * @param \core_privacy\local\request\userlist $userlist The userlist to add the users to.
     * @return void
     */
    public static function add_userids_for_context(\core_privacy\local\request\userlist $userlist);


    /**
     * Delete all data for a list of users in the specified context.
     *
     * @param \core_privacy\local\request\approved_userlist $userlist The specific context and users to delete data for.
     * @return void
     */
    public static function delete_data_for_userlist(\core_privacy\local\request\approved_userlist $userlist);
}
