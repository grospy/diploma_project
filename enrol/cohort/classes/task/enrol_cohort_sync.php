<?php
//

/**
 * Syncing enrolments task.
 *
 * @package   enrol_cohort
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_cohort\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Syncing enrolments task.
 *
 * @package   enrol_cohort
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_cohort_sync extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('enrolcohortsynctask', 'enrol_cohort');
    }

    /**
     * Run task for syncing cohort enrolments.
     */
    public function execute() {
        global $CFG;

        require_once("$CFG->dirroot/enrol/cohort/locallib.php");
        $trace = new \null_progress_trace();
        enrol_cohort_sync($trace);
        $trace->finished();
    }
}
