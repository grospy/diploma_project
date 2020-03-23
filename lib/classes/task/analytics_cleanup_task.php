<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Delete stale records from analytics tables.
 *
 * @package    core
 * @copyright  2017 David Monllao {@link http://www.davidmonllao.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class analytics_cleanup_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskanalyticscleanup', 'admin');
    }

    /**
     * Executes the clean up task.
     *
     * @return void
     */
    public function execute() {

        if (!\core_analytics\manager::is_analytics_enabled()) {
            mtrace(get_string('analyticsdisabled', 'analytics'));
            return;
        }
        $models = \core_analytics\manager::cleanup();
    }
}
