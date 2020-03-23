<?php
//

/**
 * This file contains an interface to describe classes which provide user data in some form to core.
 *
 * @package     core_privacy
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core_privacy\local\request;

defined('MOODLE_INTERNAL') || die();

/**
 * The interface is used to describe a provider which is capable of identifying the users who have data within it.
 *
 * It describes data how these requests are serviced in a specific format.
 *
 * @package     core_privacy
 * @copyright   2018 Andrew Nicols <andrew@nicols.co.uk>
 */
interface core_userlist_provider extends userlist_provider {

    /**
     * Get the list of users who have data within a context.
     *
     * @param   userlist    $userlist   The userlist containing the list of users who have data in this context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist);

    /**
     * Delete multiple users within a single context.
     *
     * @param   approved_userlist       $userlist The approved context and user information to delete information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist);
}
