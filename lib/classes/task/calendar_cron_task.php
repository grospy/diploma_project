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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/calendar/lib.php');

/**
 * Simple task to run the calendar cron.
 */
class calendar_cron_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcalendarcron', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG, $DB;

        require_once($CFG->libdir . '/bennu/bennu.inc.php');

        $time = time();
        $sql = "SELECT *
                  FROM {event_subscriptions}
                 WHERE pollinterval > 0
                   AND lastupdated + pollinterval < :time";
        $subscriptions = $DB->get_records_sql($sql, array('time' => $time));
        foreach ($subscriptions as $sub) {
            mtrace("Updating calendar subscription {$sub->name} in course {$sub->courseid}");
            try {
                $log = calendar_update_subscription_events($sub->id);
                mtrace(trim(strip_tags($log)));
            } catch (\moodle_exception $ex) {
                mtrace('Error updating calendar subscription: ' . $ex->getMessage());
            }
        }

        return true;
    }

}
