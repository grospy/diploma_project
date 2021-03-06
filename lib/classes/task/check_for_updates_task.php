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
 * Simple task to run the registration cron.
 */
class check_for_updates_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcheckforupdates', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG;
        // If enabled, fetch information about available updates and eventually notify site admins.
        if (empty($CFG->disableupdatenotifications)) {
            $updateschecker = \core\update\checker::instance();
            $updateschecker->cron();
        }

    }

}
