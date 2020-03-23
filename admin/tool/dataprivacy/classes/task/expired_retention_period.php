<?php
//

/**
 * Scheduled task to flag contexts as expired.
 *
 * @package    tool_dataprivacy
 * @copyright  2018 David Monllao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_dataprivacy\task;

use coding_exception;
use core\task\scheduled_task;
use tool_dataprivacy\api;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/dataprivacy/lib.php');

/**
 * Scheduled task to flag contexts as expired.
 *
 * @package     tool_dataprivacy
 * @copyright   2018 David Monllao
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class expired_retention_period extends scheduled_task {

    /**
     * Returns the task name.
     *
     * @return string
     */
    public function get_name() {
        return get_string('expiredretentionperiodtask', 'tool_dataprivacy');
    }

    /**
     * Run the task to flag context instances as expired.
     */
    public function execute() {
        $manager = new \tool_dataprivacy\expired_contexts_manager(new \text_progress_trace());
        list($courses, $users) = $manager->flag_expired_contexts();
        mtrace("Flagged {$courses} course contexts, and {$users} user contexts as expired");
    }
}
