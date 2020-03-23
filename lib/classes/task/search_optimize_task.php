<?php
//

/**
 * A scheduled task for global search.
 *
 * @package    core
 * @copyright  2016 Eric Merrill {@link https://www.merrilldigital.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Runs search index optimization.
 *
 * @package    core
 * @copyright  2016 Eric Merrill {@link https://www.merrilldigital.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_optimize_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskglobalsearchoptimize', 'admin');
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        if (!\core_search\manager::is_indexing_enabled()) {
            return;
        }

        $globalsearch = \core_search\manager::instance();

        // Optimize index at last.
        $globalsearch->optimize_index();
    }
}
