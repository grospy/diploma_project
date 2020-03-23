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
 * Simple task to run the plagiarism cron.
 */
class plagiarism_cron_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskplagiarismcron', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG;

        if (!empty($CFG->enableplagiarism)) {
            require_once($CFG->libdir.'/plagiarismlib.php');
            $plagiarismplugins = plagiarism_load_available_plugins();
            foreach ($plagiarismplugins as $plugin => $dir) {
                require_once($dir . '/lib.php');
                $plagiarismclass = "plagiarism_plugin_$plugin";
                $plagiarismplugin = new $plagiarismclass;
                if (method_exists($plagiarismplugin, 'cron')) {
                    mtrace('Processing cron function for plagiarism_plugin_' . $plugin . '...', '');
                    cron_trace_time_and_memory();
                    mtrace('It has been detected the class ' . $plagiarismclass . ' has a legacy cron method
                            implemented. Plagiarism plugins should implement their own schedule tasks.', '');
                    $plagiarismplugin->cron();
                }
            }
        }
    }

}
