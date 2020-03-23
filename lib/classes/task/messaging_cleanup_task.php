<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2013 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

/**
 * Simple task to delete old messaging records.
 */
class messaging_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskmessagingcleanup', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG, $DB;

        $timenow = time();

        // Cleanup read and unread notifications.
        if (!empty($CFG->messagingdeleteallnotificationsdelay)) {
            $notificationdeletetime = $timenow - $CFG->messagingdeleteallnotificationsdelay;
            $params = array('notificationdeletetime' => $notificationdeletetime);
            $DB->delete_records_select('notifications', 'timecreated < :notificationdeletetime', $params);
        }

        // Cleanup read notifications.
        if (!empty($CFG->messagingdeletereadnotificationsdelay)) {
            $notificationdeletetime = $timenow - $CFG->messagingdeletereadnotificationsdelay;
            $params = array('notificationdeletetime' => $notificationdeletetime);
            $DB->delete_records_select('notifications', 'timeread < :notificationdeletetime', $params);
        }
    }
}
