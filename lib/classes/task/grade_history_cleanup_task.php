<?php
//

/**
 * A scheduled task.
 *
 * @package    core
 * @copyright  2019 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\task;
defined('MOODLE_INTERNAL') || die();

/**
 * Simple task to clean grade history tables.
 *
 * @copyright  2019 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_history_cleanup_task extends scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskgradehistorycleanup', 'admin');
    }

    /**
     * Cleanup history tables.
     */
    public function execute() {
        global $CFG, $DB;

        if (!empty($CFG->gradehistorylifetime)) {
            $now = time();
            $histlifetime = $now - ($CFG->gradehistorylifetime * DAYSECS);
            $tables = [
                'grade_outcomes_history',
                'grade_categories_history',
                'grade_items_history',
                'grade_grades_history',
                'scale_history'
            ];
            foreach ($tables as $table) {
                if ($DB->delete_records_select($table, "timemodified < ?", [$histlifetime])) {
                    mtrace("    Deleted old grade history records from '$table'");
                }
            }
        }
    }
}
