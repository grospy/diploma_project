<?php
//

/**
 * Standard log reader/writer.
 *
 * @package    logstore_standard
 * @copyright  2014 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_standard\task;

defined('MOODLE_INTERNAL') || die();

class cleanup_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcleanup', 'logstore_standard');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $DB;

        $loglifetime = (int)get_config('logstore_standard', 'loglifetime');

        if (empty($loglifetime) || $loglifetime < 0) {
            return;
        }

        $loglifetime = time() - ($loglifetime * 3600 * 24); // Value in days.
        $lifetimep = array($loglifetime);
        $start = time();

        while ($min = $DB->get_field_select("logstore_standard_log", "MIN(timecreated)", "timecreated < ?", $lifetimep)) {
            // Break this down into chunks to avoid transaction for too long and generally thrashing database.
            // Experiments suggest deleting one day takes up to a few seconds; probably a reasonable chunk size usually.
            // If the cleanup has just been enabled, it might take e.g a month to clean the years of logs.
            $params = array(min($min + 3600 * 24, $loglifetime));
            $DB->delete_records_select("logstore_standard_log", "timecreated < ?", $params);
            if (time() > $start + 300) {
                // Do not churn on log deletion for too long each run.
                break;
            }
        }

        mtrace(" Deleted old log records from standard store.");
    }
}
