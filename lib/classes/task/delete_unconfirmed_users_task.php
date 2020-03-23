<?php
//

/**
 * Scheduled task abstract class.
 *
 * @package    core
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * Simple task to delete user accounts for users who have not confirmed in time.
 */
class delete_unconfirmed_users_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskdeleteunconfirmedusers', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG, $DB;

        $timenow = time();

        // Delete users who haven't confirmed within required period.
        if (!empty($CFG->deleteunconfirmed)) {
            $cuttime = $timenow - ($CFG->deleteunconfirmed * 3600);
            $rs = $DB->get_recordset_sql ("SELECT *
                                             FROM {user}
                                            WHERE confirmed = 0 AND timecreated > 0
                                                  AND timecreated < ? AND deleted = 0", array($cuttime));
            foreach ($rs as $user) {
                delete_user($user);
                mtrace(" Deleted unconfirmed user ".fullname($user, true)." ($user->id)");
            }
            $rs->close();
        }
    }

}
