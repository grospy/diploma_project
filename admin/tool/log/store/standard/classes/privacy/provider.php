<?php
//

/**
 * Data provider.
 *
 * @package    logstore_standard
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_standard\privacy;
defined('MOODLE_INTERNAL') || die();

use context;
use core_privacy\local\metadata\collection;
use core_privacy\local\request\contextlist;

/**
 * Data provider class.
 *
 * @package    logstore_standard
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \tool_log\local\privacy\logstore_provider,
    \tool_log\local\privacy\logstore_userlist_provider {

    use \tool_log\local\privacy\moodle_database_export_and_delete;

    /**
     * Returns metadata.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_database_table('logstore_standard_log', [
            'eventname' => 'privacy:metadata:log:eventname',
            'userid' => 'privacy:metadata:log:userid',
            'relateduserid' => 'privacy:metadata:log:relateduserid',
            'anonymous' => 'privacy:metadata:log:anonymous',
            'other' => 'privacy:metadata:log:other',
            'timecreated' => 'privacy:metadata:log:timecreated',
            'origin' => 'privacy:metadata:log:origin',
            'ip' => 'privacy:metadata:log:ip',
            'realuserid' => 'privacy:metadata:log:realuserid',
        ], 'privacy:metadata:log');
        return $collection;
    }

    /**
     * Add contexts that contain user information for the specified user.
     *
     * @param contextlist $contextlist The contextlist to add the contexts to.
     * @param int $userid The user to find the contexts for.
     * @return void
     */
    public static function add_contexts_for_userid(contextlist $contextlist, $userid) {
        $sql = "
            SELECT l.contextid
              FROM {logstore_standard_log} l
             WHERE l.userid = :userid1
                OR l.relateduserid = :userid2
                OR l.realuserid = :userid3";
        $contextlist->add_from_sql($sql, [
            'userid1' => $userid,
            'userid2' => $userid,
            'userid3' => $userid,
        ]);
    }

    /**
     * Add user IDs that contain user information for the specified context.
     *
     * @param \core_privacy\local\request\userlist $userlist The userlist to add the users to.
     * @return void
     */
    public static function add_userids_for_context(\core_privacy\local\request\userlist $userlist) {
        $params = ['contextid' => $userlist->get_context()->id];
        $sql = "SELECT userid, relateduserid, realuserid
                  FROM {logstore_standard_log}
                 WHERE contextid = :contextid";
        $userlist->add_from_sql('userid', $sql, $params);
        $userlist->add_from_sql('relateduserid', $sql, $params);
        $userlist->add_from_sql('realuserid', $sql, $params);
    }

    /**
     * Get the database object.
     *
     * @return array Containing moodle_database, string, or null values.
     */
    protected static function get_database_and_table() {
        global $DB;
        return [$DB, 'logstore_standard_log'];
    }

    /**
     * Get the path to export the logs to.
     *
     * @return array
     */
    protected static function get_export_subcontext() {
        return [get_string('privacy:path:logs', 'tool_log'), get_string('pluginname', 'logstore_standard')];
    }
}
