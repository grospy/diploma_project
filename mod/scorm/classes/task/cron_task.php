<?php
//

/**
 * A scheduled task for scorm cron.
 *
 * @package    mod_scorm
 * @copyright  2017 Abhishek kumar <ganitgenius@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_scorm\task;
defined('MOODLE_INTERNAL') || die();

/**
 * A cron_task class to be used by Tasks API.
 *
 * @copyright  2017 Abhishek kumar <ganitgenius@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron_task extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('crontask', 'mod_scorm');
    }

    /**
     * Run scorm cron.
     */
    public function execute() {
        global $CFG;
        require_once($CFG->dirroot . '/mod/scorm/lib.php');
        scorm_cron_scheduled_task();
    }

}
