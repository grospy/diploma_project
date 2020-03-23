<?php
//

namespace mod_assign\task;
defined('MOODLE_INTERNAL') || die();

/**
 * A schedule task for assignment cron.
 *
 * @package   mod_assign
 * @copyright 2019 Simey Lameze <simey@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron_task extends \core\task\scheduled_task {
    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('crontask', 'mod_assign');
    }

    /**
     * Run assignment cron.
     */
    public function execute() {
        global $CFG;

        require_once($CFG->dirroot . '/mod/assign/locallib.php');
        \assign::cron();

        $plugins = \core_component::get_plugin_list('assignsubmission');

        foreach ($plugins as $name => $plugin) {
            $disabled = get_config('assignsubmission_' . $name, 'disabled');
            if (!$disabled) {
                $class = 'assign_submission_' . $name;
                require_once($CFG->dirroot . '/mod/assign/submission/' . $name . '/locallib.php');
                $class::cron();
            }
        }
        $plugins = \core_component::get_plugin_list('assignfeedback');

        foreach ($plugins as $name => $plugin) {
            $disabled = get_config('assignfeedback_' . $name, 'disabled');
            if (!$disabled) {
                $class = 'assign_feedback_' . $name;
                require_once($CFG->dirroot . '/mod/assign/feedback/' . $name . '/locallib.php');
                $class::cron();
            }
        }

        return true;
    }
}
