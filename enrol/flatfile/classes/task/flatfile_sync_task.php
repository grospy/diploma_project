<?php
//

/**
 * Scheduled task for processing flatfile enrolments.
 *
 * @package    enrol_flatfile
 * @copyright  2014 Troy Williams
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_flatfile\task;

defined('MOODLE_INTERNAL') || die;

/**
 * Simple task to run sync enrolments.
 *
 * @copyright  2014 Troy Williams
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class flatfile_sync_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('flatfilesync', 'enrol_flatfile');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $CFG;

        require_once($CFG->dirroot . '/enrol/flatfile/lib.php');

        if (!enrol_is_enabled('flatfile')) {
            return;
        }

        // Instance of enrol_flatfile_plugin.
        $plugin = enrol_get_plugin('flatfile');
        $result = $plugin->sync(new \null_progress_trace());
        return $result;

    }

}
