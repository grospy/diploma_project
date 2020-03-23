<?php
//

/**
 * Privacy class for requesting user data.
 *
 * @package    message_email
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace message_email\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;
use \core_privacy\local\request\contextlist;
use \core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\userlist;
use \core_privacy\local\request\approved_userlist;

/**
 * Privacy class for requesting user data.
 *
 * @package    message_email
 * @copyright  2018 Mihail Geshoski <mihail@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        \core_privacy\local\metadata\provider,
        \core_privacy\local\request\core_userlist_provider,
        \core_privacy\local\request\plugin\provider {

    /**
     * Returns meta data about this system.
     *
     * @param   collection $collection The initialised collection to add items to.
     * @return  collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $messageemailmessages = [
            'useridto' => 'privacy:metadata:message_email_messages:useridto',
            'conversationid' => 'privacy:metadata:message_email_messages:conversationid',
            'messageid' => 'privacy:metadata:message_email_messages:messageid',
        ];
        // Note - this data gets deleted once the scheduled task runs.
        $collection->add_database_table('message_email_messages',
            $messageemailmessages, 'privacy:metadata:message_email_messages');

        $collection->link_external_location('smtp', [
                'recipient' => 'privacy:metadata:recipient',
                'userfrom' => 'privacy:metadata:userfrom',
                'subject' => 'privacy:metadata:subject',
                'fullmessage' => 'privacy:metadata:fullmessage',
                'fullmessagehtml' => 'privacy:metadata:fullmessagehtml',
                'attachment' => 'privacy:metadata:attachment',
                'attachname' => 'privacy:metadata:attachname',
                'replyto' => 'privacy:metadata:replyto',
                'replytoname' => 'privacy:metadata:replytoname'
        ], 'privacy:metadata:externalpurpose');

        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param   int         $userid     The user to search.
     * @return  contextlist $contextlist  The contextlist containing the list of contexts used in this plugin.
     */
    public static function get_contexts_for_userid(int $userid) : contextlist {
        $contextlist = new contextlist();
        return $contextlist;
    }

    /**
     * Get the list of users who have data within a context.
     *
     * @param   userlist    $userlist   The userlist containing the list of users who have data in this context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist) {
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
    }

    /**
     * Delete all use data which matches the specified deletion_criteria.
     *
     * @param   context $context A user context.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
    }

    /**
     * Delete multiple users within a single context.
     *
     * @param   approved_userlist       $userlist The approved context and user information to delete information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist) {
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param   approved_contextlist    $contextlist    The approved contexts and user information to delete information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
    }
}
