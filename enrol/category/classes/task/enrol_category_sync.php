<?php
//

/**
 * Syncing enrolments task.
 *
 * @package   enrol_category
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_category\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Syncing enrolments task.
 *
 * @package   enrol_category
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_category_sync extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('enrolcategorysynctask', 'enrol_category');
    }

    /**
     * Run task for syncing category enrolments.
     */
    public function execute() {
        global $CFG;

        if (!enrol_is_enabled('category')) {
            return;
        }

        require_once("$CFG->dirroot/enrol/category/locallib.php");
        $trace = new \null_progress_trace();
        enrol_category_sync_full($trace);
    }
}
