<?php
//

/**
 * Task to cleanup task logs.
 *
 * @package    core
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;

defined('MOODLE_INTERNAL') || die();

use core\task\database_logger;
use core\task\logmanager;

/**
 * A task to cleanup log entries for tasks.
 *
 * @copyright  2018 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class task_log_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('tasklogcleanup', 'admin');
    }

    /**
     * Perform the cleanup task.
     */
    public function execute() {
        $logger = logmanager::get_logger_classname();
        if (is_a($logger, database_logger::class, true)) {
            $logger::cleanup();
        }
    }
}
