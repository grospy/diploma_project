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
class registration_cron_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskregistrationcron', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        \core\hub\registration::update_cron();
    }

}
