<?php
//

/**
 * Syncing enrolments task.
 *
 * @package   enrol_manual
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace enrol_manual\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Syncing enrolments task.
 *
 * @package   enrol_manual
 * @author    Farhan Karmali <farhan6318@gmail.com>
 * @copyright Farhan Karmali
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sync_enrolments extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('syncenrolmentstask', 'enrol_manual');
    }

    /**
     * Run task for syncing enrolments.
     */
    public function execute() {
        $enrol = enrol_get_plugin('manual');
        $trace = new \text_progress_trace();
        $enrol->sync($trace);
    }
}
